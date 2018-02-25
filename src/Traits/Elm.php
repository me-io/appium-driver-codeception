<?php

namespace Appium\Traits;

use Appium\TestCase\Element;

trait Elm
{
    ////     ___ _    ___ __  __ ___ _  _ _____ ___
    ////    | __| |  | __|  \/  | __| \| |_   _/ __|
    ////    | _|| |__| _|| |\/| | _|| .` | | | \__ \
    ////    |___|____|___|_|  |_|___|_|\_| |_| |___/
    ////
    /**
     * @return \Appium\TestCase\Element
     */
    public function TestCaseElm()
    {
        return new Element($this->AppiumDriver, $this->getSessionUrl());
    }


    /**
     * @param Element $element that accepts a string
     * @param string $keys send to $element
     * @return \PHPUnit_Extensions_Selenium2TestCase_Response
     */
    public function sendKeys($element, $keys)
    {
        return $element->setValueImmediate($keys);
    }

    /**
     * @param $value
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byIOSUIAutomation($value)
    {
        return $this->TestCaseElm()->by('-ios uiautomation', $value);
    }

    /**
     * @param $value
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byIOSPredicateString($value)
    {
        return $this->TestCaseElm()->by('-ios predicate string', $value);
    }

    /**
     * @param $value
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byAndroidUIAutomator($value)
    {
        return $this->TestCaseElm()->by('-android uiautomator', $value);
    }

    /**
     * @param $value
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byAccessibilityId($value)
    {
        return $this->TestCaseElm()->by('accessibility id', $value);
    }

    /**
     * @param string $value e.g. 'container'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byClassName($value)
    {
        return $this->TestCaseElm()->by('class name', $value);
    }

    /**
     * @param string $value e.g. 'div.container'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byCssSelector($value)
    {
        return $this->TestCaseElm()->by('css selector', $value);
    }

    /**
     * @param string $value e.g. 'uniqueId'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byId($value)
    {
        return $this->TestCaseElm()->by('id', $value);
    }

    /**
     * @param string $value e.g. 'Link text'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byLinkText($value)
    {
        return $this->TestCaseElm()->by('link text', $value);
    }

    /**
     * @param string $value e.g. 'Link te'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byPartialLinkText($value)
    {
        return $this->TestCaseElm()->by('partial link text', $value);
    }

    /**
     * @param string $value e.g. 'email_address'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byName($value)
    {
        return $this->TestCaseElm()->by('name', $value);
    }

    /**
     * @param string $value e.g. 'body'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byTag($value)
    {
        return $this->TestCaseElm()->by('tag name', $value);
    }

    /**
     * @param string $value e.g. '/div[@attribute="value"]'
     *
     * @return \Appium\TestCase\Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function byXPath($value)
    {
        return $this->TestCaseElm()->by('xpath', $value);
    }

    /**
     * @param $value
     * @return \Appium\TestCase\Element
     * @link https://github.com/appium/python-client/blob/master/appium/webdriver/webdriver.py
     */
    public function byIOSClassChain($value)
    {
        return $this->TestCaseElm()->by('-ios class chain', $value);
    }
}
