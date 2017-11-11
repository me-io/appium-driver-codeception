<?php

namespace Appium;

use Appium\Remote\AppiumRemoteDriver;
use Appium\Remote\Dummy;
use Appium\TestCase\Element;
use Appium\TestCase\MultiAction;
use Appium\TestCase\Session;
use Appium\TestCase\TouchAction;
use Appium\Traits\BaseCommands;
use Codeception\Exception\ConnectionException;
use Codeception\Lib\Interfaces\ConflictsWithModule;
use Codeception\Lib\Interfaces\MultiSession as MultiSessionInterface;
use Codeception\Lib\Interfaces\RequiresPackage;
use Codeception\Lib\Interfaces\ScreenshotSaver;
use Codeception\Module as CodeceptionModule;
use Codeception\Step;
use Codeception\Test\Descriptor;
use Codeception\TestInterface;

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
    use BaseCommands;

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

    public function _requires()
    {
        return [];
    }

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

    public function _conflicts()
    {
        return 'Codeception\Lib\Interfaces\Web';
    }

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
        $filename = preg_replace('~\W~', '.', Descriptor::getTestSignature($test));
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

    public function _initializeSession()
    {
        $this->AppiumDriver = new AppiumRemoteDriver($this->selenium_url, $this->connectionTimeoutInMs);
        $this->AppiumSession = $this->AppiumDriver->startSession($this->capabilities, $this->selenium_url);
        $this->sessions[] = $this->_backupSession();
    }

    public function _loadSession($session)
    {
        $this->AppiumSession = $session;
    }

    public function _saveScreenshot($filename)
    {
        if ($this->AppiumSession !== null) {
            $this->takeScreenshot($filename);
        } else {
            codecept_debug('AppiumDriver::_saveScreenshot method has been called when AppiumDriver is not set');
            codecept_debug(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        }
    }

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

    /**
     * @param $value
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byIOSUIAutomation($value)
    {
        return $this->TestCaseElement()->by('-ios uiautomation', $value);
    }

    /**
     * @param $value
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byIOSPredicateString($value)
    {
        return $this->TestCaseElement()->by('-ios predicate string', $value);
    }

    /**
     * @param $value
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byAndroidUIAutomator($value)
    {
        return $this->TestCaseElement()->by('-android uiautomator', $value);
    }

    /**
     * @param $value
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byAccessibilityId($value)
    {
        return $this->TestCaseElement()->by('accessibility id', $value);
    }

    /**
     * @param string $value e.g. 'container'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byClassName($value)
    {
        return $this->TestCaseElement()->by('class name', $value);
    }

    /**
     * @param string $value e.g. 'div.container'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byCssSelector($value)
    {
        return $this->TestCaseElement()->by('css selector', $value);
    }

    /**
     * @param string $value e.g. 'uniqueId'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byId($value)
    {
        return $this->TestCaseElement()->by('id', $value);
    }

    /**
     * @param string $value e.g. 'Link text'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byLinkText($value)
    {
        return $this->TestCaseElement()->by('link text', $value);
    }

    /**
     * @param string $value e.g. 'Link te'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byPartialLinkText($value)
    {
        return $this->TestCaseElement()->by('partial link text', $value);
    }

    /**
     * @param string $value e.g. 'email_address'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byName($value)
    {
        return $this->TestCaseElement()->by('name', $value);
    }

    /**
     * @param string $value e.g. 'body'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byTag($value)
    {
        return $this->TestCaseElement()->by('tag name', $value);
    }

    /**
     * @param string $value e.g. '/div[@attribute="value"]'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byXPath($value)
    {
        return $this->TestCaseElement()->by('xpath', $value);
    }


    ////  _____ ___  _   _  ___ _  _     _   ___ _____ ___ ___  _  _
    //// |_   _/ _ \| | | |/ __| || |   /_\ / __|_   _|_ _/ _ \| \| |
    ////   | || (_) | |_| | (__| __ |  / _ \ (__  | |  | | (_) | .` |
    ////   |_| \___/ \___/ \___|_||_| /_/ \_\___| |_| |___\___/|_|\_|

    /**
     * @return \Appium\TestCase\TouchAction
     */
    public function getTouchAction()
    {
        return new TouchAction($this->getSessionUrl(), $this->getDriver());
    }

    ////     __  __ _   _ _  _____ ___   _____ ___  _   _  ___ _  _     _   ___ _____ ___ ___  _  _
    ////    |  \/  | | | | ||_   _|_ _| |_   _/ _ \| | | |/ __| || |   /_\ / __|_   _|_ _/ _ \| \| |
    ////    | |\/| | |_| | |__| |  | |    | || (_) | |_| | (__| __ |  / _ \ (__  | |  | | (_) | .` |
    ////    |_|  |_|\___/|____|_| |___|   |_| \___/ \___/ \___|_||_| /_/ \_\___| |_| |___\___/|_|\_|

    /**
     * @return \Appium\TestCase\MultiAction
     */
    public function getMultiAction()
    {
        return new MultiAction($this->getSessionUrl(), $this->getDriver());
    }

    ////       ___ ___  __  __ __  __   _   _  _ ___  ___
    ////      / __/ _ \|  \/  |  \/  | /_\ | \| |   \/ __|
    ////     | (_| (_) | |\/| | |\/| |/ _ \| .` | |) \__ \
    ////      \___\___/|_|  |_|_|  |_/_/ \_\_|\_|___/|___/
    ////

    const POST = 'POST';
    const GET = 'GET';
    const DEL = 'DELETE';
    const SCREENSHOT = 'screenshot';
    const HIDE_KEYBOARD = 'appium/device/hide_keyboard';
    const GET_STRINGS = 'appium/app/strings';
    const NETWORK = 'network_connection';

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
     * Take a screenshot of the current page.
     *
     * @param string $save_as The path of the screenshot to be saved.
     *
     * @return string The screenshot in PNG format.
     */
    public function takeScreenshot($save_as = null)
    {
        $data = $this->driverCommand(static::GET, static::SCREENSHOT);
        $screenshot = base64_decode($data);
        if ($save_as) {
            file_put_contents($save_as, $screenshot);
        }

        return $screenshot;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function hideKeyboard($data)
    {
        return $this->driverCommand(static::POST, static::HIDE_KEYBOARD, $data);
    }

    /**
     * @param array $data ['language', 'stringFile']
     *
     * @see https://github.com/appium/appium-base-driver/blob/master/lib/mjsonwp/routes.js
     * @return mixed
     */
    public function getStrings($data = [])
    {
        return $this->driverCommand(static::POST, static::GET_STRINGS, $data);
    }

    /**
     * @param $element that accepts a string
     * @param string to send to $element
     */
    public function sendKeys($element, $keys)
    {
        $element->setValueImmediate($keys);
    }

    /**
     * @return mixed
     */
    public function getNetworkConnection()
    {
        return $this->driverCommand(static::GET, static::NETWORK);
    }


    /**
     * @param startX x-percent at which to start
     * @param startY y-percent at which to start
     * @param endX x-percent at which to end
     * @param endY y-percent at which to end
     * @param duration (optional) time to take the swipe in ms
     *
     * @return mixed
     */
    public function swipe($startX, $startY, $endX, $endY, $duration = 800)
    {
        $action = $this->initiateTouchAction();
        $action->press(array('x' => $startX, 'y' => $startY))
            ->wait($duration)
            ->moveTo(array('x' => $endX, 'y' => $endY))
            ->wait($duration)
            ->release()
            ->perform();
        return $this;
    }

    /**
     * @return TouchAction
     */
    public function initiateTouchAction()
    {
        $session = $this->getSession();
        return new TouchAction($session->getSessionUrl(), $session->getDriver());
    }

    /**
     * @return mixed
     */
    public function launchApp()
    {
        // /appium/app/launch
        $session = $this->getSession();
        $url = $this->getSessionUrl()->descend('appium')->descend('app')->descend('launch');
        $response = $this->getDriver()->curl('POST', $url, null);
    }

}
