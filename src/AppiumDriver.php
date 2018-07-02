<?php

namespace Appium;

use Appium\Remote\AppiumRemoteDriver;
use Appium\Remote\Dummy;
use Appium\TestCase\Element;
use Appium\TestCase\Session;
use Appium\Traits\Key;
use Appium\Traits\Touch;
use Appium\Traits\Elm;
use Appium\Traits\BaseCommands;
use Appium\Traits\Util;
use Codeception\Exception\ConnectionException;
use Codeception\Lib\Interfaces\MultiSession as MultiSessionInterface;
use Codeception\Lib\Interfaces\RequiresPackage;
use Codeception\Lib\Interfaces\ScreenshotSaver;
use Codeception\Module as CodeceptionModule;
use Codeception\Step;
use Codeception\Test\Descriptor;
use Codeception\TestInterface;
use Codeception\Lib\Console\Output;

/**
 * ## Public Properties
 *
 * * `AppiumDriver` - instance of `\AppiumDriver\Remote\RemoteAppiumDriver`. Can be accessed from Helper classes
 * for complex AppiumDriver interactions.
 *
 * ```php
 * // inside Helper class
 * $this->getModule('AppiumDriver')->AppiumDriver->getKeyboard()->sendKeys('hello, AppiumDriver');
 * ```
 */
class AppiumDriver extends CodeceptionModule implements
    MultiSessionInterface,
    ScreenshotSaver,
    RequiresPackage
{
    use BaseCommands;
    use Touch;
    use Key;
    use Elm;
    use Util;

    protected $requiredFields = ['host'];
    protected $config
        = [
            'host' => '127.0.0.1',
            'port' => '4723',
            'resetAfterSuite' => true,
            'resetAfterCest' => true,
            'resetAfterStep' => false,
            'resetAfterTest' => false,
            'capabilities' => [],
            'connection_timeout' => null,
            'request_timeout' => null,
            'http_proxy' => null,
            'http_proxy_port' => null,
            'ssl_proxy' => null,
            'ssl_proxy_port' => null,
            'debug_log_entries' => 15,
        ];

    protected $wd_host;
    /** @var \PHPUnit_Extensions_Selenium2TestCase_URL */
    protected $selenium_url;
    protected $capabilities;
    protected $connectionTimeoutInMs;
    protected $requestTimeoutInMs;
    protected $test;
    protected $sessionSnapshots = [];
    protected $sessions = [];
    protected $httpProxy;
    protected $httpProxyPort;
    protected $sslProxy;
    protected $sslProxyPort;


    /**
     * @var AppiumRemoteDriver
     */
    public $AppiumDriver;
    /**
     * @var Session
     */
    public $AppiumSession;

    /**
     * @var array
     */
    protected $classes = [];

    /**
     * @return array
     */
    public function _requires()
    {
        return [];
    }

    /**
     *
     */
    public function _initialize()
    {
        $this->wd_host = sprintf('http://%s:%s/wd/hub', $this->config['host'], $this->config['port']);
        $this->selenium_url = new \PHPUnit_Extensions_Selenium2TestCase_URL(sprintf('http://%s:%s', $this->config['host'], $this->config['port']));
        $this->capabilities = $this->config['capabilities'];
        $this->outputCli("Snapshot Saved session snapshot");

        $this->connectionTimeoutInMs = $this->config['connection_timeout'] * 1000;
        $this->requestTimeoutInMs = $this->config['request_timeout'] * 1000;
        try {
            if (!empty($this->config['dummyRemote'])) {
                $this->AppiumDriver = new Dummy();
            } else {
                $this->AppiumDriver = new AppiumRemoteDriver($this->selenium_url, $this->connectionTimeoutInMs);
                $this->AppiumSession = $this->AppiumDriver->startSession($this->capabilities, $this->selenium_url);
            }

            $this->sessions[] = $this->_backupSession();
        } catch (\Exception $e) {
            throw new ConnectionException(
                $e->getMessage() . "\n \nPlease make sure that Selenium Server or PhantomJS is running."
            );
        }
    }

    /**
     * @param TestInterface $test
     */
    public function _before(TestInterface $test)
    {
        $file = $test->getMetadata()->getFilename();
        $class = $this->getClassNames($file)[0];
        $classMd5 = $class;

        if ($this->config['resetAfterCest'] && !key_exists($classMd5, $this->classes)) {
            $this->classes[$classMd5] = $class;

            if (count($this->classes) > 1) {
                $this->outputCli('Cleaning appium: before ' . $class);
                $this->cleanAppiumDriver();
            }
        }

        if (!isset($this->AppiumSession)) {
            $this->_initialize();
        }
        $test->getMetadata()->setCurrent([
            'capabilities' => $this->config['capabilities'],
        ]);
    }

    /**
     * @param TestInterface $test
     */
    public function _after(TestInterface $test)
    {

        if ($this->config['resetAfterTest']) {
            $this->outputCli('Cleaning appium: after ' . $test->getMetadata()->getName());
            $this->cleanAppiumDriver();

            return;
        }
    }

    /**
     * @param Step $step
     */
    public function _afterStep(Step $step)
    {
        // this is just to make sure AppiumDriver is cleared after suite
        if ($this->config['resetAfterStep']) {
            $this->outputCli('Cleaning appium: after ' . $step->getAction());
            $this->cleanAppiumDriver();
        }
    }

    /**
     *
     */
    public function _afterSuite()
    {
        // this is just to make sure AppiumDriver is cleared after suite
        if ($this->config['resetAfterSuite']) {
            $this->outputCli('Cleaning appium: after suite');
            $this->cleanAppiumDriver();
        }
    }

    /**
     * @param TestInterface $test
     * @param \Exception $fail
     */
    public function _failed(TestInterface $test, $fail)
    {
        // todo from appium logs
        //$this->debugAppiumDriverLogs();
        $filename = preg_replace('~\W~', '.', Descriptor::getTestSignature($test));
        $outputDir = codecept_output_dir();
        $this->_saveScreenshot($report = $outputDir . mb_strcut($filename, 0, 245, 'utf-8') . '.fail.png');
        $test->getMetadata()->addReport('png', $report);
        $this->debug("Screenshot is saved into '$outputDir' dir");
    }

    /**
     * Print out latest Selenium Logs in debug mode
     */
    public function debugAppiumDriverLogs()
    {
        // todo implement
    }

    /**
     * Turns an array of log entries into a human-readable string.
     * Each log entry is an array with the keys "timestamp", "level", and "message".
     * See https://code.google.com/p/selenium/wiki/JsonWireProtocol#Log_Entry_JSON_Object
     *
     * @param array $logEntries
     *
     * @return string
     */
    protected function formatLogEntries(array $logEntries)
    {
        $formattedLogs = '';

        foreach ($logEntries as $logEntry) {
            // Timestamp is in milliseconds, but date() requires seconds.
            $time = date('H:i:s', $logEntry['timestamp'] / 1000) .
                // Append the milliseconds to the end of the time string
                '.' . ($logEntry['timestamp'] % 1000);
            $formattedLogs .= "{$time} {$logEntry['level']} - {$logEntry['message']}\n";
        }

        return $formattedLogs;
    }

    /**
     * clean appium session
     */
    protected function cleanAppiumDriver()
    {
        foreach ($this->sessions as $session) {
            $this->_loadSession($session);
            try {
                $this->AppiumSession->stop();
            } catch (\Exception $e) {
                // Session already closed so nothing to do
            }
            unset($this->AppiumSession);
        }
        $this->sessions = [];
    }

    /**
     * @return array|null
     */
    protected function getProxy()
    {
        $proxyConfig = [];
        if ($this->config['http_proxy']) {
            $proxyConfig['httpProxy'] = $this->config['http_proxy'];
            if ($this->config['http_proxy_port']) {
                $proxyConfig['httpProxy'] .= ':' . $this->config['http_proxy_port'];
            }
        }
        if ($this->config['ssl_proxy']) {
            $proxyConfig['sslProxy'] = $this->config['ssl_proxy'];
            if ($this->config['ssl_proxy_port']) {
                $proxyConfig['sslProxy'] .= ':' . $this->config['ssl_proxy_port'];
            }
        }
        if (!empty($proxyConfig)) {
            $proxyConfig['proxyType'] = 'manual';

            return $proxyConfig;
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getDeviceName()
    {
        $cap = $this->config['capabilities'];
        return isset($cap['deviceName']) ? $cap['deviceName'] : '';
    }

    /**
     *
     */
    public function _initializeSession()
    {
        $this->AppiumDriver = new AppiumRemoteDriver($this->selenium_url, $this->connectionTimeoutInMs);
        $this->AppiumSession = $this->AppiumDriver->startSession($this->capabilities, $this->selenium_url);
        $this->sessions[] = $this->_backupSession();
    }

    /**
     * @param $session
     */
    public function _loadSession($session)
    {
        $this->AppiumSession = $session;
    }

    /**
     * @param $filename
     */
    public function _saveScreenshot($filename)
    {
        if ($this->AppiumSession !== null) {
            $this->takeScreenshotAndSave($filename);
        } else {
            codecept_debug('AppiumDriver::_saveScreenshot method has been called when AppiumDriver is not set');
            codecept_debug(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        }
    }

    /**
     * @return Session
     */
    public function _backupSession()
    {
        return $this->AppiumSession;
    }

    /**
     * @param Session $AppiumSession
     */
    public function _closeSession($AppiumSession = null)
    {
        $keys = array_keys($this->sessions, $AppiumSession, true);
        $key = array_shift($keys);
        try {
            $AppiumSession->stop();
        } catch (\Exception $e) {
            // Session already closed so nothing to do
        }
        unset($this->sessions[$key]);
    }

    /**
     * @return \Appium\Remote\AppiumRemoteDriver
     */
    public function getDriver()
    {
        return $this->AppiumDriver;
    }

    /**
     * @return \PHPUnit_Extensions_Selenium2TestCase_URL
     */
    public function getSessionUrl()
    {
        return $this->getSession()->getSessionUrl();
    }

    /**
     * @return \Appium\TestCase\Session
     */
    public function getSession()
    {
        return $this->AppiumSession;
    }

    /**
     * get class names from php file
     *
     * @param $file
     *
     * @return array
     */
    protected function getClassNames($file)
    {
        $php_code = file_get_contents($file);
        $classes = [];
        $namespace = "";
        $tokens = token_get_all($php_code);
        $count = count($tokens);

        for ($i = 0; $i < $count; $i++) {
            if ($tokens[$i][0] === T_NAMESPACE) {
                for ($j = $i + 1; $j < $count; ++$j) {
                    if ($tokens[$j][0] === T_STRING) {
                        $namespace .= "\\" . $tokens[$j][1];
                    } elseif ($tokens[$j] === '{' or $tokens[$j] === ';') {
                        break;
                    }
                }
            }
            if ($tokens[$i][0] === T_CLASS) {
                for ($j = $i + 1; $j < $count; ++$j) {
                    if ($tokens[$j] === '{') {
                        $classes[] = $namespace . "\\" . $tokens[$i + 2][1];
                    }
                }
            }
        }

        return $classes;
    }

    /**
     * print to cli
     *
     * @param $msg
     */
    public function outputCli($msg)
    {
        $output = new Output([]);
        $output->writeln('');
        $output->writeln($msg);
        $output->writeln('');
    }

    ////     ___ _    ___ __  __ ___ _  _ _____ ___
    ////    | __| |  | __|  \/  | __| \| |_   _/ __|
    ////    | _|| |__| _|| |\/| | _|| .` | | | \__ \
    ////    |___|____|___|_|  |_|___|_|\_| |_| |___/
    ////

    /**
     * @return \Appium\TestCase\Element
     */
    public function TestCaseElement()
    {
        return new Element($this->AppiumDriver, $this->getSessionUrl());
    }


    ////       ___ ___  __  __ __  __   _   _  _ ___  ___
    ////      / __/ _ \|  \/  |  \/  | /_\ | \| |   \/ __|
    ////     | (_| (_) | |\/| | |\/| |/ _ \| .` | |) \__ \
    ////      \___\___/|_|  |_|_|  |_/_/ \_\_|\_|___/|___/
    ////

    const POST = 'POST';
    const GET = 'GET';
    const DEL = 'DELETE';

    /**
     * @param $method
     * @param $command
     * @param $data
     *
     * @return mixed
     */
    public function driverCommand($method = 'POST', $command, $data = [])
    {

        $url = $this->getSession()->getSessionUrl()->descend($command);

        /** @var \PHPUnit_Extensions_Selenium2TestCase_Response $response */
        $response = $this->getDriver()->curl($method, $url, $data);

        return $response->getValue();
    }

    /**
     * @param $method
     * @param $command
     * @param $data
     *
     * @return mixed
     */
    public function driverCommandWithoutSession($method = 'POST', $command, $data = [])
    {

        $url = $this->getSession()->getSessionUrl()->descend($command);

        /** @var \PHPUnit_Extensions_Selenium2TestCase_Response $response */
        $response = $this->getDriver()->curl($method, $url, $data);

        return $response->getValue();
    }
}
