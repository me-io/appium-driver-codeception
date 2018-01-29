<?php

namespace Appium\Traits;

use Appium\TestCase\MultiAction;
use Appium\TestCase\TouchAction;

trait Touch
{
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
    public function getMultiTouchAction()
    {
        return new MultiAction($this->getSessionUrl(), $this->getDriver());
    }

    /**
     * @link https://pypkg.com/pypi/appium-python-client/f/appium/webdriver/webdriver.py
     */

    /**
     * Swipe from one point to another point, for an optional duration.
     * convenience method added to Appium (NOT Selenium 3)
     * @link https://pypkg.com/pypi/appium-python-client/f/appium/webdriver/webdriver.py
     *
     * @param string startX x-percent at which to start
     * @param string startY y-percent at which to start
     * @param string endX x-percent at which to end
     * @param string endY y-percent at which to end
     * @param int $duration (optional) time to take the swipe in ms
     *
     * @return mixed
     */
    public function swipe($startX, $startY, $endX, $endY, $duration = 800)
    {
        $action = $this->getTouchAction();
        $action->press(array('x' => $startX, 'y' => $startY))
            ->wait($duration)
            ->moveTo(array('x' => $endX, 'y' => $endY))
            ->wait($duration)
            ->release()
            ->perform();
        return $this;
    }

    /**
     * Flick from one point to another point.
     * convenience method added to Appium (NOT Selenium 3)
     * @link https://pypkg.com/pypi/appium-python-client/f/appium/webdriver/webdriver.py
     *
     * @param string startX x-percent at which to start
     * @param string startY y-percent at which to start
     * @param string endX x-percent at which to end
     * @param string endY y-percent at which to end
     *
     * @return mixed
     */
    public function flick($startX, $startY, $endX, $endY)
    {
        $action = $this->getTouchAction();
        $action->press(array('x' => $startX, 'y' => $startY))
            ->moveTo(array('x' => $endX, 'y' => $endY))
            ->release()
            ->perform();
        return $this;
    }

    /**
     * Scrolls from one element to another
     * convenience method added to Appium (NOT Selenium 3)
     * @link https://pypkg.com/pypi/appium-python-client/f/appium/webdriver/webdriver.py
     *
     * @param $originElArray array containing type ( name, xpath, id, accessibility id,.... ) of element match and value  [ 'type'=>'id' ,'value=>'email_address' ]
     * @param $destinationElArray array containing type ( name, xpath, id, accessibility id,.... ) of element match and value  [ 'type'=>'id' ,'value=>'email_address' ]
     * @param int $duration
     * @usage $this->scroll(['type'=>'id','value'=>'header_bar'],['type'=>'xpath','value'=>'div1[1]>classA>textare']);
     * @return $this
     */
    public function scroll($originElArray, $destinationElArray, $duration = 500)
    {
        $action = $this->getTouchAction();
        $action->press(['element' => $originElArray])
            ->wait($duration)
            ->moveTo(['element' => $destinationElArray])
            ->release()
            ->perform();

        return $this;


    }
}