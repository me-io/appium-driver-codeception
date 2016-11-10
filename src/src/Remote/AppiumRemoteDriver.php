<?php
namespace Appium\Remote;

use Appium\TestCase\Session;

class AppiumRemoteDriver extends \PHPUnit_Extensions_Selenium2TestCase_Driver
{
    private $seleniumServerUrl;
    private $seleniumServerRequestsTimeout;

    public function __construct(\PHPUnit_Extensions_Selenium2TestCase_URL $seleniumServerUrl, $timeout = 60)
    {
        parent::__construct($seleniumServerUrl, $timeout);

        $this->seleniumServerUrl             = $seleniumServerUrl;
        $this->seleniumServerRequestsTimeout = $timeout;
    }

    public function startSession(array $desiredCapabilities,
                                 \PHPUnit_Extensions_Selenium2TestCase_URL $browserUrl)
    {
        $sessionCreation = $this->seleniumServerUrl->descend("/wd/hub/session");
        $response        = $this->curl('POST', $sessionCreation, [
            'desiredCapabilities' => $desiredCapabilities,
        ]);
        $sessionPrefix   = $response->getURL();

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

    public function getServerUrl()
    {
        return $this->seleniumServerUrl;
    }
}
