<?php

namespace Appium\TestCase;

use Appium\Remote\AppiumRemoteDriver;

/**
 * Class Session
 */
class Session extends \PHPUnit_Extensions_Selenium2TestCase_Session
{
    /**
     * @var string  the base URL for this session,
     *              which all relative URLs will refer to
     */
    private $baseUrl;

    public function __construct(
        $driver,
        \PHPUnit_Extensions_Selenium2TestCase_URL $url,
        \PHPUnit_Extensions_Selenium2TestCase_URL $baseUrl,
        \PHPUnit_Extensions_Selenium2TestCase_Session_Timeouts $timeouts
    ) {
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

    /**
     * @return array
     */
    protected function initCommands()
    {
        $baseUrl = $this->baseUrl;
        $commands = parent::initCommands();

        $commands['contexts'] = 'PHPUnit_Extensions_Selenium2TestCase_SessionCommand_GenericAccessor';
        $commands['context'] = 'PHPUnit_Extensions_AppiumTestCase_SessionCommand_Context';

        return $commands;
    }

    /**
     * @return \PHPUnit_Extensions_Selenium2TestCase_Driver|AppiumRemoteDriver
     */
    public function getDriver()
    {
        return $this->driver;
    }
}
