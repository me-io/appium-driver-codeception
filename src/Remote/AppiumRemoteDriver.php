<?php

namespace Appium\Remote;

use Appium\TestCase\Session;

/**
 * Class AppiumRemoteDriver
 */
class AppiumRemoteDriver extends \PHPUnit_Extensions_Selenium2TestCase_Driver
{
    private $seleniumServerUrl;
    private $seleniumServerRequestsTimeout;

    /**
     * AppiumRemoteDriver constructor.
     * @param \PHPUnit_Extensions_Selenium2TestCase_URL $seleniumServerUrl
     * @param int $timeout
     */
    public function __construct(\PHPUnit_Extensions_Selenium2TestCase_URL $seleniumServerUrl, $timeout = 60)
    {
        parent::__construct($seleniumServerUrl, $timeout);

        $this->seleniumServerUrl = $seleniumServerUrl;
        $this->seleniumServerRequestsTimeout = $timeout;
    }

    /**
     * @param array $desiredCapabilities
     * @param \PHPUnit_Extensions_Selenium2TestCase_URL $browserUrl
     * @return Session
     */
    public function startSession(
        array $desiredCapabilities,
        \PHPUnit_Extensions_Selenium2TestCase_URL $browserUrl
    ) {
        $sessionCreation = $this->seleniumServerUrl->descend("/wd/hub/session");
        $response = $this->curl('POST', $sessionCreation, [
            'desiredCapabilities' => $desiredCapabilities,
        ]);
        $sessionPrefix = $response->getURL();

        $timeouts = new \PHPUnit_Extensions_Selenium2TestCase_Session_Timeouts(
            $this,
            $sessionPrefix->descend('timeouts'),
            $this->seleniumServerRequestsTimeout * 1000
        );

        return new Session(
            $this,
            $sessionPrefix,
            $browserUrl,
            $timeouts
        );
    }

    /**
     * @return \PHPUnit_Extensions_Selenium2TestCase_URL
     */
    public function getServerUrl()
    {
        return $this->seleniumServerUrl;
    }
}
