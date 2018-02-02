<?php

namespace Appium\Traits;

use Appium\TestCase\MultiAction;
use Appium\TestCase\TouchAction;

/**
 * Trait Touch
 *
 * @package Appium\Traits
 */
trait Touch
{
    /**
     * @return \Appium\TestCase\TouchAction
     */
    public function getTouchAction()
    {
        return new TouchAction($this->getSessionUrl(), $this->getDriver());
    }

    /**
     * @return \Appium\TestCase\MultiAction
     */
    public function getMultiTouchAction()
    {
        return new MultiAction($this->getSessionUrl(), $this->getDriver());
    }

    /**
     * Swipe from one point to another point, for an optional duration.
     * convenience method added to Appium (NOT Selenium 3)
     *
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
        $action->press(['x' => $startX, 'y' => $startY])
               ->wait($duration)
               ->moveTo(['x' => $endX, 'y' => $endY])
               ->wait($duration)
               ->release()
               ->perform();

        return $this;
    }

    /**
     * Flick from one point to another point.
     * convenience method added to Appium (NOT Selenium 3)
     *
     * @link https://pypkg.com/pypi/appium-python-client/f/appium/webdriver/webdriver.py
     *
     * @param string startX x-percent at which to start
     * @param string startY y-percent at which to start
     * @param string endX x-percent at which to end
     * @param string endY y-percent at which to end
     *
     * @return mixed
     */
    public function flickFromTo($startX, $startY, $endX, $endY)
    {
        $action = $this->getTouchAction();
        $action->press(['x' => $startX, 'y' => $startY])
               ->moveTo(['x' => $endX, 'y' => $endY])
               ->release()
               ->perform();

        return $this;
    }

    /**
     * Scrolls from one element to another
     * convenience method added to Appium (NOT Selenium 3)
     *
     * @link https://pypkg.com/pypi/appium-python-client/f/appium/webdriver/webdriver.py
     * @usage $this->scroll(['type'=>'id','value'=>'header_bar'],['type'=>'xpath','value'=>'div1[1]>classA>textare']);
     *
     * @param array $originElArray      the element from which to being scrolling
     * @param array $destinationElArray the element to scroll to
     * @param int   $duration
     *
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

    /**
     * Drag the origin element to the destination element
     * convenience method added to Appium (NOT Selenium 3)
     *
     * @link https://github.com/appium/python-client/blob/master/appium/webdriver/webdriver.py
     *
     * @param array $originElArray
     * @param array $destinationElArray
     * @param int   $duration
     *
     * @return \Appium\Traits\Touch
     */
    public function dragAndDrop($originElArray, $destinationElArray, $duration = 500)
    {
        $action = $this->getTouchAction();
        $action->longPress(['element' => $originElArray])
               ->wait($duration)
               ->moveTo(['element' => $destinationElArray])
               ->release()
               ->perform();

        return $this;
    }

    /**
     * Taps on an particular place with up to five fingers, holding for a certain time
     * convenience method added to Appium (NOT Selenium 3)
     *
     * @link https://github.com/appium/python-client/blob/master/appium/webdriver/webdriver.py
     * @usage $this->tap([(100, 20), (100, 60), (100, 100)], 500);
     *
     * @param array $positions
     * @param int   $duration
     *
     * @return \Appium\Traits\Touch
     */
    public function tap($positions, $duration = 500)
    {
        if (count($positions) == 1) {
            $action = $this->getTouchAction();

            $options = [
                'x' => $positions[0][0],
                'y' => $positions[0][1],
            ];

            if ($duration) {
                $options['duration'] = $duration;
                $action->longPress($options)->release()->perform();
            } else {
                $action->tap($options)->release()->perform();
            }
        } else {
            $multiTouchAction = $this->getMultiTouchAction();
            foreach ($positions as $position) {
                $action = $this->getTouchAction();

                $options = [
                    'x' => $position[0][0],
                    'y' => $position[0][1],
                ];

                if ($duration) {
                    $options['duration'] = $duration;
                    $action->longPress($options)->release()->perform();
                } else {
                    $action->tap($options)->release()->perform();
                }
                $multiTouchAction->add($action);
            }
            $multiTouchAction->perform();
        }

        return $this;
    }

    /**
     * Pinch on an element a certain amount
     * convenience method added to Appium (NOT Selenium 3)
     *
     * @link https://github.com/appium/python-client/blob/master/appium/webdriver/webdriver.py
     * @usage $this->pinch($element)
     *
     * @param null $element the element to pinch
     * @param int  $percent amount to pinch. Defaults to 200%
     * @param int  $steps   number of steps in the pinch action
     *
     * @return \Appium\Traits\Touch
     */
    public function pinch($element = null, $percent = 200, $steps = 50)
    {
        if ($element) {
            $element = $element['id'];
        }

        $options = [
            'element' => $element,
            'percent' => $percent,
            'steps'   => $steps,
        ];

        $this->execute([
            'mobile: pinchClose',
            $options,
        ]);

        return $this;
    }

    /**
     * Pinch on an element a certain amount
     * convenience method added to Appium (NOT Selenium 3)
     *
     * @link https://github.com/appium/python-client/blob/master/appium/webdriver/webdriver.py
     * @usage $this->zoom($element)
     *
     * @param null $element the element to zoom
     * @param int  $percent amount to pinch. Defaults to 200%
     * @param int  $steps   number of steps in the pinch action
     *
     * @return \Appium\Traits\Touch
     */
    public function zoom($element = null, $percent = 200, $steps = 50)
    {
        if ($element) {
            $element = $element['id'];
        }

        $options = [
            'element' => $element,
            'percent' => $percent,
            'steps'   => $steps,
        ];

        $this->execute([
            'mobile: pinchOpen',
            $options,
        ]);

        return $this;
    }
}
