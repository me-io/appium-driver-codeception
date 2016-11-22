<?php 
namespace Appium\Tools\Output;

 trait AppiumCommands 
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
	public function timeouts($data){
			return $this->driverCommand(Constants::$POST, Constants::$TIMEOUTS, $data);
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
	public function asyncScriptTimeout($data){
			return $this->driverCommand(Constants::$POST, Constants::$ASYNC_SCRIPT, $data);
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
	public function implicitWait($data){
			return $this->driverCommand(Constants::$POST, Constants::$IMPLICIT_WAIT, $data);
	}
	/**
	* getWindowHandle
	*
	*
	**/
	public function getWindowHandle(){
			return $this->driverCommand(Constants::$GET, Constants::$WINDOW_HANDLE);
	}
	/**
	* getWindowHandles
	*
	*
	**/
	public function getWindowHandles(){
			return $this->driverCommand(Constants::$GET, Constants::$WINDOW_HANDLES);
	}
	/**
	* getUrl
	*
	*
	**/
	public function getUrl(){
			return $this->driverCommand(Constants::$GET, Constants::$URL);
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
	public function setUrl($data){
			return $this->driverCommand(Constants::$POST, Constants::$URL, $data);
	}
	/**
	* forward
	*
	*
	**/
	public function forward(){
			return $this->driverCommand(Constants::$POST, Constants::$FORWARD);
	}
	/**
	* back
	*
	*
	**/
	public function back(){
			return $this->driverCommand(Constants::$POST, Constants::$BACK);
	}
	/**
	* refresh
	*
	*
	**/
	public function refresh(){
			return $this->driverCommand(Constants::$POST, Constants::$REFRESH);
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
	public function execute($data){
			return $this->driverCommand(Constants::$POST, Constants::$EXECUTE, $data);
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
	public function executeAsync($data){
			return $this->driverCommand(Constants::$POST, Constants::$EXECUTE_ASYNC, $data);
	}
	/**
	* getScreenshot
	*
	*
	**/
	public function getScreenshot(){
			return $this->driverCommand(Constants::$GET, Constants::$SCREENSHOT);
	}
	/**
	* availableIMEEngines
	*
	*
	**/
	public function availableIMEEngines(){
			return $this->driverCommand(Constants::$GET, Constants::$AVAILABLE_ENGINES);
	}
	/**
	* getActiveIMEEngine
	*
	*
	**/
	public function getActiveIMEEngine(){
			return $this->driverCommand(Constants::$GET, Constants::$ACTIVE_ENGINE);
	}
	/**
	* isIMEActivated
	*
	*
	**/
	public function isIMEActivated(){
			return $this->driverCommand(Constants::$GET, Constants::$ACTIVATED);
	}
	/**
	* deactivateIMEEngine
	*
	*
	**/
	public function deactivateIMEEngine(){
			return $this->driverCommand(Constants::$POST, Constants::$DEACTIVATE);
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
	public function activateIMEEngine($data){
			return $this->driverCommand(Constants::$POST, Constants::$ACTIVATE, $data);
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
	public function setFrame($data){
			return $this->driverCommand(Constants::$POST, Constants::$FRAME, $data);
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
	public function setWindow($data){
			return $this->driverCommand(Constants::$POST, Constants::$WINDOW, $data);
	}
	/**
	* closeWindow
	*
	*
	**/
	public function closeWindow(){
			return $this->driverCommand(Constants::$DELETE, Constants::$WINDOW);
	}
	/**
	* getWindowSize
	*
	*
	**/
	public function getWindowSize($windowhandle){
			$url = Constants::$SIZE;
	$url = str_replace(':windowhandle', $windowhandle, Constants::$SIZE);
		return $this->driverCommand(Constants::$GET, $url);
	}
	/**
	* maximizeWindow
	*
	*
	**/
	public function maximizeWindow($windowhandle){
			$url = Constants::$MAXIMIZE;
	$url = str_replace(':windowhandle', $windowhandle, Constants::$MAXIMIZE);
		return $this->driverCommand(Constants::$POST, $url);
	}
	/**
	* getCookies
	*
	*
	**/
	public function getCookies(){
			return $this->driverCommand(Constants::$GET, Constants::$COOKIE);
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
	public function setCookie($data){
			return $this->driverCommand(Constants::$POST, Constants::$COOKIE, $data);
	}
	/**
	* deleteCookies
	*
	*
	**/
	public function deleteCookies(){
			return $this->driverCommand(Constants::$DELETE, Constants::$COOKIE);
	}
	/**
	* deleteCookie
	*
	*
	**/
	public function deleteCookie($name){
			$url = Constants::$COOKIE_NAME;
	$url = str_replace(':name', $name, Constants::$COOKIE_NAME);
		return $this->driverCommand(Constants::$DELETE, $url);
	}
	/**
	* getPageSource
	*
	*
	**/
	public function getPageSource(){
			return $this->driverCommand(Constants::$GET, Constants::$SOURCE);
	}
	/**
	* title
	*
	*
	**/
	public function title(){
			return $this->driverCommand(Constants::$GET, Constants::$TITLE);
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
	public function findElement($data){
			return $this->driverCommand(Constants::$POST, Constants::$ELEMENT, $data);
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
	public function findElements($data){
			return $this->driverCommand(Constants::$POST, Constants::$ELEMENTS, $data);
	}
	/**
	* active
	*
	*
	**/
	public function active(){
			return $this->driverCommand(Constants::$POST, Constants::$ACTIVE);
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
	public function findElementFromElement($data, $elementId){
			$url = Constants::$ELEMENT__ELEMENTID;
	$url = str_replace(':elementId', $elementId, Constants::$ELEMENT__ELEMENTID);
		return $this->driverCommand(Constants::$POST, $url, $data);
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
	public function findElementsFromElement($data, $elementId){
			$url = Constants::$ELEMENTS__ELEMENTID;
	$url = str_replace(':elementId', $elementId, Constants::$ELEMENTS__ELEMENTID);
		return $this->driverCommand(Constants::$POST, $url, $data);
	}
	/**
	* click
	*
	*
	**/
	public function click($elementId){
			$url = Constants::$CLICK;
	$url = str_replace(':elementId', $elementId, Constants::$CLICK);
		return $this->driverCommand(Constants::$POST, $url);
	}
	/**
	* submit
	*
	*
	**/
	public function submit($elementId){
			$url = Constants::$SUBMIT;
	$url = str_replace(':elementId', $elementId, Constants::$SUBMIT);
		return $this->driverCommand(Constants::$POST, $url);
	}
	/**
	* getText
	*
	*
	**/
	public function getText($elementId){
			$url = Constants::$TEXT;
	$url = str_replace(':elementId', $elementId, Constants::$TEXT);
		return $this->driverCommand(Constants::$GET, $url);
	}
	/**
	* setValue
	*
	* @param array $data
	* @options {"required":["value"]}
	*
	* @return mixed
	*
	**/
	public function setValue($data, $elementId){
			$url = Constants::$VALUE;
	$url = str_replace(':elementId', $elementId, Constants::$VALUE);
		return $this->driverCommand(Constants::$POST, $url, $data);
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
	public function keys($data){
			return $this->driverCommand(Constants::$POST, Constants::$KEYS, $data);
	}
	/**
	* getName
	*
	*
	**/
	public function getName($elementId){
			$url = Constants::$NAME;
	$url = str_replace(':elementId', $elementId, Constants::$NAME);
		return $this->driverCommand(Constants::$GET, $url);
	}
	/**
	* clear
	*
	*
	**/
	public function clear($elementId){
			$url = Constants::$CLEAR;
	$url = str_replace(':elementId', $elementId, Constants::$CLEAR);
		return $this->driverCommand(Constants::$POST, $url);
	}
	/**
	* elementSelected
	*
	*
	**/
	public function elementSelected($elementId){
			$url = Constants::$SELECTED;
	$url = str_replace(':elementId', $elementId, Constants::$SELECTED);
		return $this->driverCommand(Constants::$GET, $url);
	}
	/**
	* elementEnabled
	*
	*
	**/
	public function elementEnabled($elementId){
			$url = Constants::$ENABLED;
	$url = str_replace(':elementId', $elementId, Constants::$ENABLED);
		return $this->driverCommand(Constants::$GET, $url);
	}
	/**
	* getAttribute
	*
	*
	**/
	public function getAttribute($elementId, $name){
			$url = Constants::$ATTRIBUTE_NAME;
	$url = str_replace(':elementId', $elementId, Constants::$ATTRIBUTE_NAME);
		$url = str_replace(':name', $name, Constants::$ATTRIBUTE_NAME);
		return $this->driverCommand(Constants::$GET, $url);
	}
	/**
	* equalsElement
	*
	*
	**/
	public function equalsElement($elementId, $otherId){
			$url = Constants::$EQUALS_OTHERID;
	$url = str_replace(':elementId', $elementId, Constants::$EQUALS_OTHERID);
		$url = str_replace(':otherId', $otherId, Constants::$EQUALS_OTHERID);
		return $this->driverCommand(Constants::$GET, $url);
	}
	/**
	* elementDisplayed
	*
	*
	**/
	public function elementDisplayed($elementId){
			$url = Constants::$DISPLAYED;
	$url = str_replace(':elementId', $elementId, Constants::$DISPLAYED);
		return $this->driverCommand(Constants::$GET, $url);
	}
	/**
	* getLocation
	*
	*
	**/
	public function getLocation($elementId){
			$url = Constants::$LOCATION;
	$url = str_replace(':elementId', $elementId, Constants::$LOCATION);
		return $this->driverCommand(Constants::$GET, $url);
	}
	/**
	* getLocationInView
	*
	*
	**/
	public function getLocationInView($elementId){
			$url = Constants::$LOCATION_IN_VIEW;
	$url = str_replace(':elementId', $elementId, Constants::$LOCATION_IN_VIEW);
		return $this->driverCommand(Constants::$GET, $url);
	}
	/**
	* getSize
	*
	*
	**/
	public function getSize($elementId){
			$url = Constants::$SIZE__ELEMENTID;
	$url = str_replace(':elementId', $elementId, Constants::$SIZE__ELEMENTID);
		return $this->driverCommand(Constants::$GET, $url);
	}
	/**
	* getCssProperty
	*
	*
	**/
	public function getCssProperty($elementId, $propertyName){
			$url = Constants::$CSS_PROPERTYNAME;
	$url = str_replace(':elementId', $elementId, Constants::$CSS_PROPERTYNAME);
		$url = str_replace(':propertyName', $propertyName, Constants::$CSS_PROPERTYNAME);
		return $this->driverCommand(Constants::$GET, $url);
	}
	/**
	* getOrientation
	*
	*
	**/
	public function getOrientation(){
			return $this->driverCommand(Constants::$GET, Constants::$ORIENTATION);
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
	public function setOrientation($data){
			return $this->driverCommand(Constants::$POST, Constants::$ORIENTATION, $data);
	}
	/**
	* getRotation
	*
	*
	**/
	public function getRotation(){
			return $this->driverCommand(Constants::$GET, Constants::$ROTATION);
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
	public function setRotation($data){
			return $this->driverCommand(Constants::$POST, Constants::$ROTATION, $data);
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
	public function moveTo($data){
			return $this->driverCommand(Constants::$POST, Constants::$MOVETO, $data);
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
	public function clickCurrent($data){
			return $this->driverCommand(Constants::$POST, Constants::$CLICK_, $data);
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
	public function touchDown($data){
			return $this->driverCommand(Constants::$POST, Constants::$DOWN, $data);
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
	public function touchUp($data){
			return $this->driverCommand(Constants::$POST, Constants::$UP, $data);
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
	public function touchMove($data){
			return $this->driverCommand(Constants::$POST, Constants::$MOVE, $data);
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
	public function touchLongClick($data){
			return $this->driverCommand(Constants::$POST, Constants::$LONGCLICK, $data);
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
	public function flick($data){
			return $this->driverCommand(Constants::$POST, Constants::$FLICK, $data);
	}
	/**
	* getGeoLocation
	*
	*
	**/
	public function getGeoLocation(){
			return $this->driverCommand(Constants::$GET, Constants::$LOCATION_);
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
	public function setGeoLocation($data){
			return $this->driverCommand(Constants::$POST, Constants::$LOCATION_, $data);
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
	public function getLog($data){
			return $this->driverCommand(Constants::$POST, Constants::$LOG, $data);
	}
	/**
	* getLogTypes
	*
	*
	**/
	public function getLogTypes(){
			return $this->driverCommand(Constants::$GET, Constants::$TYPES);
	}
	/**
	* getCurrentContext
	*
	*
	**/
	public function getCurrentContext(){
			return $this->driverCommand(Constants::$GET, Constants::$CONTEXT);
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
	public function setContext($data){
			return $this->driverCommand(Constants::$POST, Constants::$CONTEXT, $data);
	}
	/**
	* getContexts
	*
	*
	**/
	public function getContexts(){
			return $this->driverCommand(Constants::$GET, Constants::$CONTEXTS);
	}
	/**
	* getPageIndex
	*
	*
	**/
	public function getPageIndex($elementId){
			$url = Constants::$PAGEINDEX;
	$url = str_replace(':elementId', $elementId, Constants::$PAGEINDEX);
		return $this->driverCommand(Constants::$GET, $url);
	}
	/**
	* getNetworkConnection
	*
	*
	**/
	public function getNetworkConnection(){
			return $this->driverCommand(Constants::$GET, Constants::$NETWORK_CONNECTION);
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
	public function setNetworkConnection($data){
			return $this->driverCommand(Constants::$POST, Constants::$NETWORK_CONNECTION, $data);
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
	public function performTouch($data){
			return $this->driverCommand(Constants::$POST, Constants::$PERFORM, $data);
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
	public function performMultiAction($data){
			return $this->driverCommand(Constants::$POST, Constants::$PERFORM_MULTI, $data);
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
	public function receiveAsyncResponse($data){
			return $this->driverCommand(Constants::$POST, Constants::$RECEIVE_ASYNC_RESPONSE, $data);
	}
	/**
	* mobileShake
	*
	*
	**/
	public function mobileShake(){
			return $this->driverCommand(Constants::$POST, Constants::$SHAKE);
	}
	/**
	* getDeviceTime
	*
	*
	**/
	public function getDeviceTime(){
			return $this->driverCommand(Constants::$GET, Constants::$SYSTEM_TIME);
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
	public function lock($data){
			return $this->driverCommand(Constants::$POST, Constants::$LOCK, $data);
	}
	/**
	* unlock
	*
	*
	**/
	public function unlock(){
			return $this->driverCommand(Constants::$POST, Constants::$UNLOCK);
	}
	/**
	* isLocked
	*
	*
	**/
	public function isLocked(){
			return $this->driverCommand(Constants::$POST, Constants::$IS_LOCKED);
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
	public function pressKeyCode($data){
			return $this->driverCommand(Constants::$POST, Constants::$PRESS_KEYCODE, $data);
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
	public function longPressKeyCode($data){
			return $this->driverCommand(Constants::$POST, Constants::$LONG_PRESS_KEYCODE, $data);
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
	public function fingerprint($data){
			return $this->driverCommand(Constants::$POST, Constants::$FINGER_PRINT, $data);
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
	public function keyevent($data){
			return $this->driverCommand(Constants::$POST, Constants::$KEYEVENT, $data);
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
	public function mobileRotation($data){
			return $this->driverCommand(Constants::$POST, Constants::$ROTATE, $data);
	}
	/**
	* getCurrentActivity
	*
	*
	**/
	public function getCurrentActivity(){
			return $this->driverCommand(Constants::$GET, Constants::$CURRENT_ACTIVITY);
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
	public function installApp($data){
			return $this->driverCommand(Constants::$POST, Constants::$INSTALL_APP, $data);
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
	public function removeApp($data){
			return $this->driverCommand(Constants::$POST, Constants::$REMOVE_APP, $data);
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
	public function isAppInstalled($data){
			return $this->driverCommand(Constants::$POST, Constants::$APP_INSTALLED, $data);
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
	public function hideKeyboard($data){
			return $this->driverCommand(Constants::$POST, Constants::$HIDE_KEYBOARD, $data);
	}
	/**
	* isKeyboardShown
	*
	*
	**/
	public function isKeyboardShown(){
			return $this->driverCommand(Constants::$GET, Constants::$IS_KEYBOARD_SHOWN);
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
	public function pushFile($data){
			return $this->driverCommand(Constants::$POST, Constants::$PUSH_FILE, $data);
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
	public function pullFile($data){
			return $this->driverCommand(Constants::$POST, Constants::$PULL_FILE, $data);
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
	public function pullFolder($data){
			return $this->driverCommand(Constants::$POST, Constants::$PULL_FOLDER, $data);
	}
	/**
	* toggleFlightMode
	*
	*
	**/
	public function toggleFlightMode(){
			return $this->driverCommand(Constants::$POST, Constants::$TOGGLE_AIRPLANE_MODE);
	}
	/**
	* toggleData
	*
	*
	**/
	public function toggleData(){
			return $this->driverCommand(Constants::$POST, Constants::$TOGGLE_DATA);
	}
	/**
	* toggleWiFi
	*
	*
	**/
	public function toggleWiFi(){
			return $this->driverCommand(Constants::$POST, Constants::$TOGGLE_WIFI);
	}
	/**
	* toggleLocationServices
	*
	*
	**/
	public function toggleLocationServices(){
			return $this->driverCommand(Constants::$POST, Constants::$TOGGLE_LOCATION_SERVICES);
	}
	/**
	* openNotifications
	*
	*
	**/
	public function openNotifications(){
			return $this->driverCommand(Constants::$POST, Constants::$OPEN_NOTIFICATIONS);
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
	public function startActivity($data){
			return $this->driverCommand(Constants::$POST, Constants::$START_ACTIVITY, $data);
	}
	/**
	* getSystemBars
	*
	*
	**/
	public function getSystemBars(){
			return $this->driverCommand(Constants::$GET, Constants::$SYSTEM_BARS);
	}
	/**
	* getDisplayDensity
	*
	*
	**/
	public function getDisplayDensity(){
			return $this->driverCommand(Constants::$GET, Constants::$DISPLAY_DENSITY);
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
	public function touchId($data){
			return $this->driverCommand(Constants::$POST, Constants::$TOUCH_ID, $data);
	}
	/**
	* launchApp
	*
	*
	**/
	public function launchApp(){
			return $this->driverCommand(Constants::$POST, Constants::$LAUNCH);
	}
	/**
	* closeApp
	*
	*
	**/
	public function closeApp(){
			return $this->driverCommand(Constants::$POST, Constants::$CLOSE);
	}
	/**
	* reset
	*
	*
	**/
	public function reset(){
			return $this->driverCommand(Constants::$POST, Constants::$RESET);
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
	public function background($data){
			return $this->driverCommand(Constants::$POST, Constants::$BACKGROUND, $data);
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
	public function endCoverage($data){
			return $this->driverCommand(Constants::$POST, Constants::$END_TEST_COVERAGE, $data);
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
	public function getStrings($data){
			return $this->driverCommand(Constants::$POST, Constants::$STRINGS, $data);
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
	public function setValueImmediate($data, $elementId){
			$url = Constants::$VALUE__ELEMENTID;
	$url = str_replace(':elementId', $elementId, Constants::$VALUE__ELEMENTID);
		return $this->driverCommand(Constants::$POST, $url, $data);
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
	public function replaceValue($data, $elementId){
			$url = Constants::$REPLACE_VALUE;
	$url = str_replace(':elementId', $elementId, Constants::$REPLACE_VALUE);
		return $this->driverCommand(Constants::$POST, $url, $data);
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
	public function updateSettings($data){
			return $this->driverCommand(Constants::$POST, Constants::$SETTINGS, $data);
	}
	/**
	* getSettings
	*
	*
	**/
	public function getSettings(){
			return $this->driverCommand(Constants::$GET, Constants::$SETTINGS);
	}
	/**
	* getAlertText
	*
	*
	**/
	public function getAlertText(){
			return $this->driverCommand(Constants::$GET, Constants::$TEXT_ALERT);
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
	public function setAlertText($data){
			return $this->driverCommand(Constants::$POST, Constants::$TEXT_ALERT, $data);
	}
	/**
	* postAcceptAlert
	*
	*
	**/
	public function postAcceptAlert(){
			return $this->driverCommand(Constants::$POST, Constants::$ACCEPT);
	}
	/**
	* postDismissAlert
	*
	*
	**/
	public function postDismissAlert(){
			return $this->driverCommand(Constants::$POST, Constants::$DISMISS);
	}
	/**
	* getElementRect
	*
	*
	**/
	public function getElementRect($elementId){
			$url = Constants::$RECT;
	$url = str_replace(':elementId', $elementId, Constants::$RECT);
		return $this->driverCommand(Constants::$GET, $url);
	}  
}
