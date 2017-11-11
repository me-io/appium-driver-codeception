<?php

namespace Appium\Traits;

trait BaseCommands
{

    /**
     * timeouts
     *
     * @param array $data
     * @options {"required":["type","ms"]}
     *
     * @return mixed
     *
     **/
    public function timeouts($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$TIMEOUTS, $data);
    }

    /**
     * asyncScriptTimeout
     *
     * @param array $data
     * @options {"required":["ms"]}
     *
     * @return mixed
     *
     **/
    public function asyncScriptTimeout($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$ASYNC_SCRIPT, $data);
    }

    /**
     * implicitWait
     *
     * @param array $data
     * @options {"required":["ms"]}
     *
     * @return mixed
     *
     **/
    public function implicitWait($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$IMPLICIT_WAIT, $data);
    }

    /**
     * getWindowHandle
     *
     *
     **/
    public function getWindowHandle()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$WINDOW_HANDLE);
    }

    /**
     * getWindowHandles
     *
     *
     **/
    public function getWindowHandles()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$WINDOW_HANDLES);
    }

    /**
     * getUrl
     *
     *
     **/
    public function getUrl()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$URL);
    }

    /**
     * setUrl
     *
     * @param array $data
     * @options {"required":["url"]}
     *
     * @return mixed
     *
     **/
    public function setUrl($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$URL, $data);
    }

    /**
     * forward
     *
     *
     **/
    public function forward()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$FORWARD);
    }

    /**
     * back
     *
     *
     **/
    public function back()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$BACK);
    }

    /**
     * refresh
     *
     *
     **/
    public function refresh()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$REFRESH);
    }

    /**
     * execute
     *
     * @param array $data
     * @options {"required":["script","args"]}
     *
     * @return mixed
     *
     **/
    public function execute($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$EXECUTE, $data);
    }

    /**
     * executeAsync
     *
     * @param array $data
     * @options {"required":["script","args"]}
     *
     * @return mixed
     *
     **/
    public function executeAsync($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$EXECUTE_ASYNC, $data);
    }

    /**
     * getScreenshot
     *
     *
     **/
    public function getScreenshot()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$SCREENSHOT);
    }

    /**
     * availableIMEEngines
     *
     *
     **/
    public function availableIMEEngines()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$AVAILABLE_ENGINES);
    }

    /**
     * getActiveIMEEngine
     *
     *
     **/
    public function getActiveIMEEngine()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$ACTIVE_ENGINE);
    }

    /**
     * isIMEActivated
     *
     *
     **/
    public function isIMEActivated()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$ACTIVATED);
    }

    /**
     * deactivateIMEEngine
     *
     *
     **/
    public function deactivateIMEEngine()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$DEACTIVATE);
    }

    /**
     * activateIMEEngine
     *
     * @param array $data
     * @options {"required":["engine"]}
     *
     * @return mixed
     *
     **/
    public function activateIMEEngine($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$ACTIVATE, $data);
    }

    /**
     * setFrame
     *
     * @param array $data
     * @options {"required":["id"]}
     *
     * @return mixed
     *
     **/
    public function setFrame($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$FRAME, $data);
    }

    /**
     * setWindow
     *
     * @param array $data
     * @options {"required":["name"]}
     *
     * @return mixed
     *
     **/
    public function setWindow($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$WINDOW, $data);
    }

    /**
     * closeWindow
     *
     *
     **/
    public function closeWindow()
    {
        return $this->driverCommand(BaseConstants::$DELETE, BaseConstants::$WINDOW);
    }

    /**
     * getWindowSize
     *
     *
     **/
    public function getWindowSize($windowhandle)
    {
        $url = str_replace(':windowhandle', $windowhandle, BaseConstants::$SIZE);
        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * maximizeWindow
     *
     *
     **/
    public function maximizeWindow($windowhandle)
    {
        $url = str_replace(':windowhandle', $windowhandle, BaseConstants::$MAXIMIZE);
        return $this->driverCommand(BaseConstants::$POST, $url);
    }

    /**
     * getCookies
     *
     *
     **/
    public function getCookies()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$COOKIE);
    }

    /**
     * setCookie
     *
     * @param array $data
     * @options {"required":["cookie"]}
     *
     * @return mixed
     *
     **/
    public function setCookie($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$COOKIE, $data);
    }

    /**
     * deleteCookies
     *
     *
     **/
    public function deleteCookies()
    {
        return $this->driverCommand(BaseConstants::$DELETE, BaseConstants::$COOKIE);
    }

    /**
     * deleteCookie
     *
     *
     **/
    public function deleteCookie($name)
    {
        $url = str_replace(':name', $name, BaseConstants::$COOKIE_NAME);
        return $this->driverCommand(BaseConstants::$DELETE, $url);
    }

    /**
     * getPageSource
     *
     *
     **/
    public function getPageSource()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$SOURCE);
    }

    /**
     * title
     *
     *
     **/
    public function title()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$TITLE);
    }

    /**
     * findElement
     *
     * @param array $data
     * @options {"required":["using","value"]}
     *
     * @return mixed
     *
     **/
    public function findElement($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$ELEMENT, $data);
    }

    /**
     * findElements
     *
     * @param array $data
     * @options {"required":["using","value"]}
     *
     * @return mixed
     *
     **/
    public function findElements($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$ELEMENTS, $data);
    }

    /**
     * active
     *
     *
     **/
    public function active()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$ACTIVE);
    }

    /**
     * findElementFromElement
     *
     * @param array $data
     * @options {"required":["using","value"]}
     *
     * @return mixed
     *
     **/
    public function findElementFromElement($data, $elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$ELEMENT__ELEMENTID);
        return $this->driverCommand(BaseConstants::$POST, $url, $data);
    }

    /**
     * findElementsFromElement
     *
     * @param array $data
     * @options {"required":["using","value"]}
     *
     * @return mixed
     *
     **/
    public function findElementsFromElement($data, $elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$ELEMENTS__ELEMENTID);
        return $this->driverCommand(BaseConstants::$POST, $url, $data);
    }

    /**
     * click
     *
     *
     **/
    public function click($elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$CLICK);
        return $this->driverCommand(BaseConstants::$POST, $url);
    }

    /**
     * submit
     *
     *
     **/
    public function submit($elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$SUBMIT);
        return $this->driverCommand(BaseConstants::$POST, $url);
    }

    /**
     * getText
     *
     *
     **/
    public function getText($elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$TEXT);
        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * setValue
     *
     * @param array $data
     * @options {"validate":[],"optional":["value","text"],"makeArgs":[]}
     *
     * @return mixed
     *
     **/
    public function setValue($data, $elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$VALUE);
        return $this->driverCommand(BaseConstants::$POST, $url, $data);
    }

    /**
     * keys
     *
     * @param array $data
     * @options {"required":["value"]}
     *
     * @return mixed
     *
     **/
    public function keys($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$KEYS, $data);
    }

    /**
     * getName
     *
     *
     **/
    public function getName($elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$NAME);
        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * clear
     *
     *
     **/
    public function clear($elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$CLEAR);
        return $this->driverCommand(BaseConstants::$POST, $url);
    }

    /**
     * elementSelected
     *
     *
     **/
    public function elementSelected($elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$SELECTED);
        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * elementEnabled
     *
     *
     **/
    public function elementEnabled($elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$ENABLED);
        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * getAttribute
     *
     *
     **/
    public function getAttribute($elementId, $name)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$ATTRIBUTE_NAME);
        $url = str_replace(':name', $name, BaseConstants::$ATTRIBUTE_NAME);
        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * equalsElement
     *
     *
     **/
    public function equalsElement($elementId, $otherId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$EQUALS_OTHERID);
        $url = str_replace(':otherId', $otherId, BaseConstants::$EQUALS_OTHERID);
        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * elementDisplayed
     *
     *
     **/
    public function elementDisplayed($elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$DISPLAYED);
        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * getLocation
     *
     *
     **/
    public function getLocation($elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$LOCATION);
        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * getLocationInView
     *
     *
     **/
    public function getLocationInView($elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$LOCATION_IN_VIEW);
        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * getSize
     *
     *
     **/
    public function getSize($elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$SIZE__ELEMENTID);
        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * getCssProperty
     *
     *
     **/
    public function getCssProperty($elementId, $propertyName)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$CSS_PROPERTYNAME);
        $url = str_replace(':propertyName', $propertyName, BaseConstants::$CSS_PROPERTYNAME);
        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * getOrientation
     *
     *
     **/
    public function getOrientation()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$ORIENTATION);
    }

    /**
     * setOrientation
     *
     * @param array $data
     * @options {"required":["orientation"]}
     *
     * @return mixed
     *
     **/
    public function setOrientation($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$ORIENTATION, $data);
    }

    /**
     * getRotation
     *
     *
     **/
    public function getRotation()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$ROTATION);
    }

    /**
     * setRotation
     *
     * @param array $data
     * @options {"required":["x","y","z"]}
     *
     * @return mixed
     *
     **/
    public function setRotation($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$ROTATION, $data);
    }

    /**
     * moveTo
     *
     * @param array $data
     * @options {"optional":["element","xoffset","yoffset"]}
     *
     * @return mixed
     *
     **/
    public function moveTo($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$MOVETO, $data);
    }

    /**
     * clickCurrent
     *
     * @param array $data
     * @options {"optional":["button"]}
     *
     * @return mixed
     *
     **/
    public function clickCurrent($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$CLICK_, $data);
    }

    /**
     * touchDown
     *
     * @param array $data
     * @options {"required":["x","y"]}
     *
     * @return mixed
     *
     **/
    public function touchDown($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$DOWN, $data);
    }

    /**
     * touchUp
     *
     * @param array $data
     * @options {"required":["x","y"]}
     *
     * @return mixed
     *
     **/
    public function touchUp($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$UP, $data);
    }

    /**
     * touchMove
     *
     * @param array $data
     * @options {"required":["x","y"]}
     *
     * @return mixed
     *
     **/
    public function touchMove($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$MOVE, $data);
    }

    /**
     * touchLongClick
     *
     * @param array $data
     * @options {"required":["elements"]}
     *
     * @return mixed
     *
     **/
    public function touchLongClick($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$LONGCLICK, $data);
    }

    /**
     * flick
     *
     * @param array $data
     * @options {"optional":["element","xspeed","yspeed","xoffset","yoffset","speed"]}
     *
     * @return mixed
     *
     **/
    public function flick($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$FLICK, $data);
    }

    /**
     * getGeoLocation
     *
     *
     **/
    public function getGeoLocation()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$LOCATION_);
    }

    /**
     * setGeoLocation
     *
     * @param array $data
     * @options {"required":["location"]}
     *
     * @return mixed
     *
     **/
    public function setGeoLocation($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$LOCATION_, $data);
    }

    /**
     * getLog
     *
     * @param array $data
     * @options {"required":["type"]}
     *
     * @return mixed
     *
     **/
    public function getLog($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$LOG, $data);
    }

    /**
     * getLogTypes
     *
     *
     **/
    public function getLogTypes()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$TYPES);
    }

    /**
     * getCurrentContext
     *
     *
     **/
    public function getCurrentContext()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$CONTEXT);
    }

    /**
     * setContext
     *
     * @param array $data
     * @options {"required":["name"]}
     *
     * @return mixed
     *
     **/
    public function setContext($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$CONTEXT, $data);
    }

    /**
     * getContexts
     *
     *
     **/
    public function getContexts()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$CONTEXTS);
    }

    /**
     * getPageIndex
     *
     *
     **/
    public function getPageIndex($elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$PAGEINDEX);
        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * getNetworkConnection
     *
     *
     **/
    public function getNetworkConnection()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$NETWORK_CONNECTION);
    }

    /**
     * setNetworkConnection
     *
     * @param array $data
     * @options {"unwrap":"parameters","required":["type"]}
     *
     * @return mixed
     *
     **/
    public function setNetworkConnection($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$NETWORK_CONNECTION, $data);
    }

    /**
     * performTouch
     *
     * @param array $data
     * @options {"wrap":"actions","required":["actions"]}
     *
     * @return mixed
     *
     **/
    public function performTouch($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$PERFORM, $data);
    }

    /**
     * performMultiAction
     *
     * @param array $data
     * @options {"required":["actions"],"optional":["elementId"]}
     *
     * @return mixed
     *
     **/
    public function performMultiAction($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$PERFORM_MULTI, $data);
    }

    /**
     * receiveAsyncResponse
     *
     * @param array $data
     * @options {"required":["status","value"]}
     *
     * @return mixed
     *
     **/
    public function receiveAsyncResponse($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$RECEIVE_ASYNC_RESPONSE, $data);
    }

    /**
     * mobileShake
     *
     *
     **/
    public function mobileShake()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$SHAKE);
    }

    /**
     * getDeviceTime
     *
     *
     **/
    public function getDeviceTime()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$SYSTEM_TIME);
    }

    /**
     * lock
     *
     * @param array $data
     * @options {"optional":["seconds"]}
     *
     * @return mixed
     *
     **/
    public function lock($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$LOCK, $data);
    }

    /**
     * unlock
     *
     *
     **/
    public function unlock()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$UNLOCK);
    }

    /**
     * isLocked
     *
     *
     **/
    public function isLocked()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$IS_LOCKED);
    }

    /**
     * startRecordingScreen
     *
     * @param array $data
     * @options {"required":["filePath","videoSize","timeLimit","bitRate"]}
     *
     * @return mixed
     *
     **/
    public function startRecordingScreen($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$START_RECORDING_SCREEN, $data);
    }

    /**
     * stopRecordingScreen
     *
     *
     **/
    public function stopRecordingScreen()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$STOP_RECORDING_SCREEN);
    }

    /**
     * getPerformanceDataTypes
     *
     *
     **/
    public function getPerformanceDataTypes()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$TYPES_PERFORMANCEDATA);
    }

    /**
     * getPerformanceData
     *
     * @param array $data
     * @options {"required":["packageName","dataType"],"optional":["dataReadTimeout"]}
     *
     * @return mixed
     *
     **/
    public function getPerformanceData($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$GETPERFORMANCEDATA, $data);
    }

    /**
     * pressKeyCode
     *
     * @param array $data
     * @options {"required":["keycode"],"optional":["metastate"]}
     *
     * @return mixed
     *
     **/
    public function pressKeyCode($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$PRESS_KEYCODE, $data);
    }

    /**
     * longPressKeyCode
     *
     * @param array $data
     * @options {"required":["keycode"],"optional":["metastate"]}
     *
     * @return mixed
     *
     **/
    public function longPressKeyCode($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$LONG_PRESS_KEYCODE, $data);
    }

    /**
     * fingerprint
     *
     * @param array $data
     * @options {"required":["fingerprintId"]}
     *
     * @return mixed
     *
     **/
    public function fingerprint($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$FINGER_PRINT, $data);
    }

    /**
     * sendSMS
     *
     * @param array $data
     * @options {"required":["phoneNumber","message"]}
     *
     * @return mixed
     *
     **/
    public function sendSMS($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$SEND_SMS, $data);
    }

    /**
     * gsmCall
     *
     * @param array $data
     * @options {"required":["phoneNumber","action"]}
     *
     * @return mixed
     *
     **/
    public function gsmCall($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$GSM_CALL, $data);
    }

    /**
     * gsmSignal
     *
     * @param array $data
     * @options {"required":["signalStrengh"]}
     *
     * @return mixed
     *
     **/
    public function gsmSignal($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$GSM_SIGNAL, $data);
    }

    /**
     * gsmVoice
     *
     * @param array $data
     * @options {"required":["state"]}
     *
     * @return mixed
     *
     **/
    public function gsmVoice($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$GSM_VOICE, $data);
    }

    /**
     * powerCapacity
     *
     * @param array $data
     * @options {"required":["percent"]}
     *
     * @return mixed
     *
     **/
    public function powerCapacity($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$POWER_CAPACITY, $data);
    }

    /**
     * powerAC
     *
     * @param array $data
     * @options {"required":["state"]}
     *
     * @return mixed
     *
     **/
    public function powerAC($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$POWER_AC, $data);
    }

    /**
     * networkSpeed
     *
     * @param array $data
     * @options {"required":["netspeed"]}
     *
     * @return mixed
     *
     **/
    public function networkSpeed($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$NETWORK_SPEED, $data);
    }

    /**
     * keyevent
     *
     * @param array $data
     * @options {"required":["keycode"],"optional":["metastate"]}
     *
     * @return mixed
     *
     **/
    public function keyevent($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$KEYEVENT, $data);
    }

    /**
     * mobileRotation
     *
     * @param array $data
     * @options {"required":["x","y","radius","rotation","touchCount","duration"],"optional":["element"]}
     *
     * @return mixed
     *
     **/
    public function mobileRotation($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$ROTATE, $data);
    }

    /**
     * getCurrentActivity
     *
     *
     **/
    public function getCurrentActivity()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$CURRENT_ACTIVITY);
    }

    /**
     * getCurrentPackage
     *
     *
     **/
    public function getCurrentPackage()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$CURRENT_PACKAGE);
    }

    /**
     * installApp
     *
     * @param array $data
     * @options {"required":["appPath"]}
     *
     * @return mixed
     *
     **/
    public function installApp($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$INSTALL_APP, $data);
    }

    /**
     * removeApp
     *
     * @param array $data
     * @options {"required":[["appId"],["bundleId"]]}
     *
     * @return mixed
     *
     **/
    public function removeApp($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$REMOVE_APP, $data);
    }

    /**
     * isAppInstalled
     *
     * @param array $data
     * @options {"required":["bundleId"]}
     *
     * @return mixed
     *
     **/
    public function isAppInstalled($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$APP_INSTALLED, $data);
    }

    /**
     * hideKeyboard
     *
     * @param array $data
     * @options {"optional":["strategy","key","keyCode","keyName"]}
     *
     * @return mixed
     *
     **/
    public function hideKeyboard($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$HIDE_KEYBOARD, $data);
    }

    /**
     * isKeyboardShown
     *
     *
     **/
    public function isKeyboardShown()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$IS_KEYBOARD_SHOWN);
    }

    /**
     * pushFile
     *
     * @param array $data
     * @options {"required":["path","data"]}
     *
     * @return mixed
     *
     **/
    public function pushFile($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$PUSH_FILE, $data);
    }

    /**
     * pullFile
     *
     * @param array $data
     * @options {"required":["path"]}
     *
     * @return mixed
     *
     **/
    public function pullFile($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$PULL_FILE, $data);
    }

    /**
     * pullFolder
     *
     * @param array $data
     * @options {"required":["path"]}
     *
     * @return mixed
     *
     **/
    public function pullFolder($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$PULL_FOLDER, $data);
    }

    /**
     * toggleFlightMode
     *
     *
     **/
    public function toggleFlightMode()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$TOGGLE_AIRPLANE_MODE);
    }

    /**
     * toggleData
     *
     *
     **/
    public function toggleData()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$TOGGLE_DATA);
    }

    /**
     * toggleWiFi
     *
     *
     **/
    public function toggleWiFi()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$TOGGLE_WIFI);
    }

    /**
     * toggleLocationServices
     *
     *
     **/
    public function toggleLocationServices()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$TOGGLE_LOCATION_SERVICES);
    }

    /**
     * openNotifications
     *
     *
     **/
    public function openNotifications()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$OPEN_NOTIFICATIONS);
    }

    /**
     * startActivity
     *
     * @param array $data
     * @options {"required":["appPackage","appActivity"],"optional":["appWaitPackage","appWaitActivity","intentAction","intentCategory","intentFlags","optionalIntentArguments","dontStopAppOnReset"]}
     *
     * @return mixed
     *
     **/
    public function startActivity($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$START_ACTIVITY, $data);
    }

    /**
     * getSystemBars
     *
     *
     **/
    public function getSystemBars()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$SYSTEM_BARS);
    }

    /**
     * getDisplayDensity
     *
     *
     **/
    public function getDisplayDensity()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$DISPLAY_DENSITY);
    }

    /**
     * touchId
     *
     * @param array $data
     * @options {"required":["match"]}
     *
     * @return mixed
     *
     **/
    public function touchId($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$TOUCH_ID, $data);
    }

    /**
     * toggleEnrollTouchId
     *
     * @param array $data
     * @options {"optional":["enabled"]}
     *
     * @return mixed
     *
     **/
    public function toggleEnrollTouchId($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$TOGGLE_TOUCH_ID_ENROLLMENT, $data);
    }

    /**
     * launchApp
     *
     *
     **/
    public function launchApp()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$LAUNCH);
    }

    /**
     * closeApp
     *
     *
     **/
    public function closeApp()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$CLOSE);
    }

    /**
     * reset
     *
     *
     **/
    public function reset()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$RESET);
    }

    /**
     * background
     *
     * @param array $data
     * @options {"required":["seconds"]}
     *
     * @return mixed
     *
     **/
    public function background($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$BACKGROUND, $data);
    }

    /**
     * endCoverage
     *
     * @param array $data
     * @options {"required":["intent","path"]}
     *
     * @return mixed
     *
     **/
    public function endCoverage($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$END_TEST_COVERAGE, $data);
    }

    /**
     * getStrings
     *
     * @param array $data
     * @options {"optional":["language","stringFile"]}
     *
     * @return mixed
     *
     **/
    public function getStrings($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$STRINGS, $data);
    }

    /**
     * setValueImmediate
     *
     * @param array $data
     * @options {"required":["value"]}
     *
     * @return mixed
     *
     **/
    public function setValueImmediate($data, $elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$VALUE__ELEMENTID);
        return $this->driverCommand(BaseConstants::$POST, $url, $data);
    }

    /**
     * replaceValue
     *
     * @param array $data
     * @options {"required":["value"]}
     *
     * @return mixed
     *
     **/
    public function replaceValue($data, $elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$REPLACE_VALUE);
        return $this->driverCommand(BaseConstants::$POST, $url, $data);
    }

    /**
     * updateSettings
     *
     * @param array $data
     * @options {"required":["settings"]}
     *
     * @return mixed
     *
     **/
    public function updateSettings($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$SETTINGS, $data);
    }

    /**
     * getSettings
     *
     *
     **/
    public function getSettings()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$SETTINGS);
    }

    /**
     * getAlertText
     *
     *
     **/
    public function getAlertText()
    {
        return $this->driverCommand(BaseConstants::$GET, BaseConstants::$ALERT_TEXT);
    }

    /**
     * setAlertText
     *
     * @param array $data
     * @options {"required":["text"]}
     *
     * @return mixed
     *
     **/
    public function setAlertText($data)
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$ALERT_TEXT, $data);
    }

    /**
     * postAcceptAlert
     *
     *
     **/
    public function postAcceptAlert()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$ACCEPT_ALERT);
    }

    /**
     * postDismissAlert
     *
     *
     **/
    public function postDismissAlert()
    {
        return $this->driverCommand(BaseConstants::$POST, BaseConstants::$DISMISS_ALERT);
    }

    /**
     * getElementRect
     *
     *
     **/
    public function getElementRect($elementId)
    {
        $url = str_replace(':elementId', $elementId, BaseConstants::$RECT);
        return $this->driverCommand(BaseConstants::$GET, $url);
    }
}
