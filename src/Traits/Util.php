<?php

namespace Appium\Traits;

use Appium\Remote\AppiumRemoteDriver;

trait Util
{
    /**
     * Take a screenshot of the current page.
     *
     * @param string $save_as The path of the screenshot to be saved.
     *
     * @return string The screenshot in PNG format.
     */
    public function takeScreenshot($save_as = null)
    {
        $data = $this->driverCommand(static::GET, BaseConstants::$SCREENSHOT);
        $screenshot = base64_decode($data);
        if ($save_as) {
            file_put_contents($save_as, $screenshot);
        }

        return $screenshot;
    }


    /**
     *
     * @return \PHPUnit_Extensions_Selenium2TestCase_Response
     */
    public function launchAppiumApp()
    {
        /** @var \PHPUnit_Extensions_Selenium2TestCase_URL $sessionUrl */
        $sessionUrl = $this->getSessionUrl();
        /** @var  AppiumRemoteDriver $driver */
        $driver = $this->getDriver();

        // appium/app/launch
        $url = $sessionUrl->descend('appium')->descend('app')->descend('launch');
        $response = $driver->curl('POST', $url, null);

        return $response;
    }

    /**
     * DESC
     * @param $latitude
     * @param $longitude
     * @param $altitude
     * @return mixed
     * @usage $this->setLocation(100,150,200);
     * @author Anoop Ambunhi <anoop.nair@tajawal.com>
     *
     */
    public function setLocation($latitude, $longitude, $altitude)
    {
        $data = [
            $location = [
                'latitude' => strval($latitude),
                'longitude' => strval($longitude),
                'altitude' => strval($altitude),
            ]
        ];
        return $this->driverCommand(BaseConstants::$POST, '/location', $data);
    }
}
