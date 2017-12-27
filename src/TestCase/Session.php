<?php

namespace Appium\TestCase;

use PHPUnit_Extensions_Selenium2TestCase_Element;
use PHPUnit_Extensions_Selenium2TestCase_Session_Timeouts;
use PHPUnit_Extensions_Selenium2TestCase_URL;

/**
 * Class Session
 *
 * @package Appium\TestCase
 */
class Session extends \PHPUnit_Extensions_Selenium2TestCase_Session
{
    /**
     * @var string  the base URL for this session, which all relative URLs will refer to
     */
    private $baseUrl;

    /**
     * Session constructor.
     *
     * @param                                                        $driver
     * @param PHPUnit_Extensions_Selenium2TestCase_URL               $url
     * @param PHPUnit_Extensions_Selenium2TestCase_URL               $baseUrl
     * @param PHPUnit_Extensions_Selenium2TestCase_Session_Timeouts  $timeouts
     */
    public function __construct($driver, PHPUnit_Extensions_Selenium2TestCase_URL $url, PHPUnit_Extensions_Selenium2TestCase_URL $baseUrl, PHPUnit_Extensions_Selenium2TestCase_Session_Timeouts $timeouts)
    {
        $this->baseUrl = $baseUrl;

        parent::__construct($driver, $url, $baseUrl, $timeouts);
    }

    /**
     * @param array $value WebElement JSON object
     *
     * @return PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function elementFromResponseValue($value)
    {
        return PHPUnit_Extensions_Selenium2TestCase_Element::fromResponseValue($value, $this->getSessionUrl()->descend('element'), $this->driver);
    }

    /**
     * @return \PHPUnit_Extensions_Selenium2TestCase_Response
     */
    public function reset()
    {
        $url = $this->getSessionUrl()->addCommand('appium/app/reset');

        return $this->driver->curl('POST', $url);
    }

    /**
     * @param null $language
     *
     * @return mixed
     */
    public function appStrings($language = null)
    {
        $url  = $this->getSessionUrl()->addCommand('appium/app/strings');
        $data = [];

        if (!is_null($language)) {
            $data['language'] = $language;
        }

        return $this->driver->curl('POST', $url, $data)->getValue();
    }


    /**
     * @param      $keycode
     * @param null $metastate
     *
     * @return \PHPUnit_Extensions_Selenium2TestCase_Response
     */
    public function keyEvent($keycode, $metastate = null)
    {
        $url  = $this->getSessionUrl()->addCommand('appium/device/keyevent');
        $data = [
            'keycode'   => $keycode,
            'metastate' => $metastate,
        ];

        return $this->driver->curl('POST', $url, $data);
    }

    /**
     * @return mixed
     */
    public function currentActivity()
    {
        $url = $this->getSessionUrl()->addCommand('appium/device/current_activity');

        return $this->driver->curl('GET', $url)->getValue();
    }

    /**
     * @return array
     */
    protected function initCommands()
    {
        $commands = parent::initCommands();

        $commands['contexts'] = 'PHPUnit_Extensions_Selenium2TestCase_SessionCommand_GenericAccessor';
        $commands['context']  = 'PHPUnit_Extensions_AppiumTestCase_SessionCommand_Context';

        return $commands;
    }

    /**
     * @return \PHPUnit_Extensions_Selenium2TestCase_Driver
     */
    public function getDriver()
    {
        return $this->driver;
    }
}
