<?php
namespace Appium\Driver;

use Appium\Driver\Remote\Dummy;
use Codeception\Exception\ConnectionException;
use Codeception\Lib\Interfaces\ConflictsWithModule;
use Codeception\Lib\Interfaces\MultiSession as MultiSessionInterface;
use Codeception\Lib\Interfaces\RequiresPackage;
use Codeception\Lib\Interfaces\ScreenshotSaver;
use Codeception\Module as CodeceptionModule;
use Codeception\Step;
use Codeception\Test\Descriptor;
use Codeception\TestInterface;
use Facebook\WebDriver\Exception\UnknownServerException;
use Facebook\WebDriver\Exception\WebDriverCurlException;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\WebDriverCapabilityType;

/**
 * ## Public Properties
 *
 * * `AppiumDriver` - instance of `\Meabed\AppiumDriver\Remote\RemoteAppiumDriver`. Can be accessed from Helper classes
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
    ConflictsWithModule,
    RequiresPackage
{
    protected $requiredFields = ['host'];
    protected $config
                              = [
            'host'               => '127.0.0.1',
            'port'               => '4723',
            'resetAfterSuite'    => true,
            'resetAfterCest'     => true,
            'resetAfterStep'     => false,
            'resetAfterTest'     => false,
            'capabilities'       => [],
            'connection_timeout' => null,
            'request_timeout'    => null,
            'http_proxy'         => null,
            'http_proxy_port'    => null,
            'ssl_proxy'          => null,
            'ssl_proxy_port'     => null,
            'debug_log_entries'  => 15,
        ];

    protected $wd_host;
    protected $capabilities;
    protected $connectionTimeoutInMs;
    protected $requestTimeoutInMs;
    protected $test;
    protected $sessionSnapshots = [];
    protected $sessions         = [];
    protected $httpProxy;
    protected $httpProxyPort;
    protected $sslProxy;
    protected $sslProxyPort;

    /**
     * @var RemoteWebDriver
     */
    public $AppiumDriver;

    /**
     * @var array
     */
    protected $classes = [];

    public function _requires()
    {
        return [];
    }

    public function _initialize()
    {
        $this->wd_host      = sprintf('http://%s:%s/wd/hub', $this->config['host'], $this->config['port']);
        $this->capabilities = $this->config['capabilities'];
        if ($proxy = $this->getProxy()) {
            $this->capabilities[WebDriverCapabilityType::PROXY] = $proxy;
        }
        $this->outputCli("Snapshot Saved session snapshot");

        $this->connectionTimeoutInMs = $this->config['connection_timeout'] * 1000;
        $this->requestTimeoutInMs    = $this->config['request_timeout'] * 1000;
        try {
            if (!empty($this->config['dummyRemote'])) {
                $this->AppiumDriver = new Dummy();

            } else {
                $this->AppiumDriver = RemoteWebDriver::create(
                    $this->wd_host,
                    $this->capabilities,
                    $this->connectionTimeoutInMs,
                    $this->requestTimeoutInMs,
                    $this->httpProxy,
                    $this->httpProxyPort
                );
            }

            $this->sessions[] = $this->_backupSession();
        } catch (WebDriverCurlException $e) {
            throw new ConnectionException(
                $e->getMessage() . "\n \nPlease make sure that Selenium Server or PhantomJS is running."
            );
        }
    }

    public function _conflicts()
    {
        return 'Codeception\Lib\Interfaces\Web';
    }

    public function _before(TestInterface $test)
    {
        $file     = $test->getMetadata()->getFilename();
        $class    = $this->getClassNames($file)[0];
        $classMd5 = $class;

        if ($this->config['resetAfterCest'] && !key_exists($classMd5, $this->classes)) {
            $this->classes[$classMd5] = $class;

            if (count($this->classes) > 1) {
                $this->outputCli('Cleaning appium: before ' . $class);
                $this->cleanAppiumDriver();
            }

        }

        if (!isset($this->AppiumDriver)) {
            $this->_initialize();
        }
        $test->getMetadata()->setCurrent([
            'capabilities' => $this->config['capabilities'],
        ]);

    }

    public function _after(TestInterface $test)
    {

        if ($this->config['resetAfterTest']) {
            $this->outputCli('Cleaning appium: after ' . $test->getMetadata()->getName());
            $this->cleanAppiumDriver();

            return;
        }
    }

    public function _afterStep(Step $step)
    {
        // this is just to make sure AppiumDriver is cleared after suite
        if ($this->config['resetAfterStep']) {
            $this->outputCli('Cleaning appium: after ' . $step->getAction());
            $this->cleanAppiumDriver();
        }
    }

    public function _afterSuite()
    {
        // this is just to make sure AppiumDriver is cleared after suite
        if ($this->config['resetAfterSuite']) {
            $this->outputCli('Cleaning appium: after suite');
            $this->cleanAppiumDriver();
        }
    }

    public function _failed(TestInterface $test, $fail)
    {
        // todo from appium logs
        //$this->debugAppiumDriverLogs();
        $filename  = preg_replace('~\W~', '.', Descriptor::getTestSignature($test));
        $outputDir = codecept_output_dir();
        $this->_saveScreenshot($outputDir . mb_strcut($filename, 0, 245, 'utf-8') . '.fail.png');
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
                $this->AppiumDriver->quit();
            } catch (UnknownServerException $e) {
                // Session already closed so nothing to do
            }
            unset($this->AppiumDriver);
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


    public function _initializeSession()
    {
        $this->AppiumDriver = RemoteWebDriver::create($this->wd_host, $this->capabilities);
        $this->sessions[]   = $this->_backupSession();
        $this->AppiumDriver->manage()->timeouts()->implicitlyWait($this->config['wait']);
    }

    public function _loadSession($session)
    {
        $this->AppiumDriver = $session;
    }

    public function _saveScreenshot($filename)
    {
        if ($this->AppiumDriver !== null) {
            $this->AppiumDriver->takeScreenshot($filename);
        } else {
            codecept_debug('AppiumDriver::_saveScreenshot method has been called when AppiumDriver is not set');
            codecept_debug(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        }
    }

    /**
     * @return RemoteWebDriver
     */
    public function _backupSession()
    {
        return $this->AppiumDriver;
    }

    /**
     * @param $AppiumDriver
     */
    public function _closeSession($AppiumDriver)
    {
        $keys = array_keys($this->sessions, $AppiumDriver, true);
        $key  = array_shift($keys);
        try {
            $AppiumDriver->quit();
        } catch (UnknownServerException $e) {
            // Session already closed so nothing to do
        }
        unset($this->sessions[$key]);
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
        $php_code  = file_get_contents($file);
        $classes   = [];
        $namespace = "";
        $tokens    = token_get_all($php_code);
        $count     = count($tokens);

        for ($i = 0; $i < $count; $i++) {
            if ($tokens[$i][0] === T_NAMESPACE) {
                for ($j = $i + 1; $j < $count; ++$j) {
                    if ($tokens[$j][0] === T_STRING)
                        $namespace .= "\\" . $tokens[$j][1];
                    elseif ($tokens[$j] === '{' or $tokens[$j] === ';')
                        break;
                }
            }
            if ($tokens[$i][0] === T_CLASS) {
                for ($j = $i + 1; $j < $count; ++$j)
                    if ($tokens[$j] === '{') {
                        $classes[] = $namespace . "\\" . $tokens[$i + 2][1];
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
        $output = new \Codeception\Lib\Console\Output([]);
        $output->writeln('');
        $output->writeln($msg);
        $output->writeln('');

    }

}
