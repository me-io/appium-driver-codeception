<?php

namespace Appium\TestCase;

class Session
    extends \PHPUnit_Extensions_Selenium2TestCase_Session
{
    /**
     * @var string  the base URL for this session,
     *              which all relative URLs will refer to
     */
    private $baseUrl;

    public function __construct($driver,
                                \PHPUnit_Extensions_Selenium2TestCase_URL $url,
                                \PHPUnit_Extensions_Selenium2TestCase_URL $baseUrl,
                                \PHPUnit_Extensions_Selenium2TestCase_Session_Timeouts $timeouts)
    {
        $this->baseUrl = $baseUrl;
        parent::__construct($driver, $url, $baseUrl, $timeouts);
    }

    /**
     * @param array $value WebElement JSON object
     *
     * @return \PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function elementFromResponseValue($value)
    {
        return \PHPUnit_Extensions_Selenium2TestCase_Element::fromResponseValue($value, $this->getSessionUrl()->descend('element'), $this->driver);
    }

    public function reset()
    {
        $url = $this->getSessionUrl()->addCommand('appium/app/reset');
        $this->driver->curl('POST', $url);
    }

    public function appStrings($language = null)
    {
        $url  = $this->getSessionUrl()->addCommand('appium/app/strings');
        $data = [];
        if (!is_null($language)) {
            $data['language'] = $language;
        }

        return $this->driver->curl('POST', $url, $data)->getValue();
    }

    public function keyEvent($keycode, $metastate = null)
    {
        $url  = $this->getSessionUrl()->addCommand('appium/device/keyevent');
        $data = [
            'keycode'   => $keycode,
            'metastate' => $metastate,
        ];
        $this->driver->curl('POST', $url, $data);
    }

    public function currentActivity()
    {
        $url = $this->getSessionUrl()->addCommand('appium/device/current_activity');

        return $this->driver->curl('GET', $url)->getValue();
    }

    protected function initCommands()
    {
        $baseUrl  = $this->baseUrl;
        $commands = parent::initCommands();

        $commands['contexts'] = 'PHPUnit_Extensions_Selenium2TestCase_SessionCommand_GenericAccessor';
        $commands['context']  = 'PHPUnit_Extensions_AppiumTestCase_SessionCommand_Context';

        return $commands;
    }

    public function getDriver()
    {
        return $this->driver;
    }
}
