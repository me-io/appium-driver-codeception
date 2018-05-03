<?php
namespace Appium\Traits;

trait BaseCommands
{

    /**
     * getStatus
     *
     * Query the server's current status.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getStatus()
    {
        return $this->driverCommand(BaseConstants::$GET, '/status');
    }

    /**
     * createSession
     *
     * Create a new session.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"optional":["desiredCapabilities","requiredCapabilities","capabilities"]}
     *
     * @return mixed
     *
     **/
    public function createSession($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/session', $data);
    }

    /**
     * getSessions
     *
     * Returns a list of the currently active sessions.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getSessions()
    {
        return $this->driverCommand(BaseConstants::$GET, '/sessions');
    }

    /**
     * timeouts
     *
     * Configure the amount of time that a particular type of operation can execute for before they are aborted and a
     * |Timeout| error is returned to the client.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"optional":["type","ms","script","pageLoad","implicit"]}
     *
     * @return mixed
     *
     **/
    public function timeouts($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/timeouts', $data);
    }

    /**
     * asyncScriptTimeout
     *
     * Set the amount of time, in milliseconds, that asynchronous scripts executed by /session/:sessionId/execute_async
     * are permitted to run before they are aborted and a |Timeout| error is returned to the client.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["ms"]}
     *
     * @return mixed
     *
     **/
    public function asyncScriptTimeout($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/timeouts/async_script', $data);
    }

    /**
     * implicitWait
     *
     * Set the amount of time the driver should wait when searching for elements.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["ms"]}
     *
     * @return mixed
     *
     **/
    public function implicitWait($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/timeouts/implicit_wait', $data);
    }

    /**
     * getWindowHandle
     *
     * NOTE: Discard the duplicate function (getWindowHandle) with 'window_handle'.
     *
     * Retrieve the current window handle.
     * get /wd/hub/session/:sessionid/window
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getWindowHandle()
    {
        return $this->driverCommand(BaseConstants::$GET, '/window');
    }

    /**
     * getWindowHandles
     *
     * NOTE: Discard the duplicate function (getWindowHandles) with 'window_handles'.
     *
     * Retrieve the list of all window handles available to the session.
     *
     * get /wd/hub/session/:sessionid/window/handles
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getWindowHandles()
    {
        return $this->driverCommand(BaseConstants::$GET, '/window/handles');
    }

    /**
     * getUrl
     *
     * Retrieve the URL of the current page.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getUrl()
    {
        return $this->driverCommand(BaseConstants::$GET, '/url');
    }

    /**
     * setUrl
     *
     * Navigate to a new URL.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["url"]}
     *
     * @return mixed
     *
     **/
    public function setUrl($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/url', $data);
    }

    /**
     * forward
     *
     * Navigate forwards in the browser history, if possible.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function forward()
    {
        return $this->driverCommand(BaseConstants::$POST, '/forward');
    }

    /**
     * back
     *
     * Navigate backwards in the browser history, if possible.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function back()
    {
        return $this->driverCommand(BaseConstants::$POST, '/back');
    }

    /**
     * refresh
     *
     * Refresh the current page.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function refresh()
    {
        return $this->driverCommand(BaseConstants::$POST, '/refresh');
    }

    /**
     * execute
     *
     * Inject a snippet of JavaScript into the page for execution in the context of the currently selected frame.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["script","args"]}
     *
     * @return mixed
     *
     **/
    public function execute($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/execute/sync', $data);
    }

    /**
     * executeAsync
     *
     * Inject a snippet of JavaScript into the page for asynchronous execution in the context of the currently selected
     * frame.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["script","args"]}
     *
     * @return mixed
     *
     **/
    public function executeAsync($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/execute/async', $data);
    }

    /**
     * getScreenshot
     *
     * Take a screenshot of the current page.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getScreenshot()
    {
        return $this->driverCommand(BaseConstants::$GET, '/screenshot');
    }

    /**
     * availableIMEEngines
     *
     * List all available engines on the machine.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function availableIMEEngines()
    {
        return $this->driverCommand(BaseConstants::$GET, '/ime/available_engines');
    }

    /**
     * getActiveIMEEngine
     *
     * Get the name of the active IME engine.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getActiveIMEEngine()
    {
        return $this->driverCommand(BaseConstants::$GET, '/ime/active_engine');
    }

    /**
     * isIMEActivated
     *
     * Indicates whether IME input is active at the moment (not if it's available).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function isIMEActivated()
    {
        return $this->driverCommand(BaseConstants::$GET, '/ime/activated');
    }

    /**
     * deactivateIMEEngine
     *
     * De-activates the currently-active IME engine.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function deactivateIMEEngine()
    {
        return $this->driverCommand(BaseConstants::$POST, '/ime/deactivate');
    }

    /**
     * activateIMEEngine
     *
     * Make an engines that is available (appears on the listreturned by getAvailableEngines) active.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["engine"]}
     *
     * @return mixed
     *
     **/
    public function activateIMEEngine($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/ime/activate', $data);
    }

    /**
     * setFrame
     *
     * Change focus to another frame on the page.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["id"]}
     *
     * @return mixed
     *
     **/
    public function setFrame($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/frame', $data);
    }

    /**
     * setWindow
     *
     * Change focus to another window.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["name"]}
     *
     * @return mixed
     *
     **/
    public function setWindow($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/window', $data);
    }

    /**
     * closeWindow
     *
     * Close the current window.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function closeWindow()
    {
        return $this->driverCommand(BaseConstants::$DELETE, '/window');
    }

    /**
     * postWindowSize
     *
     * Change the size of the specified window.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function postWindowSize($windowhandle)
    {
        $url = '/window/:windowhandle/size';
        $url = str_ireplace(':windowhandle', $windowhandle, $url);

        return $this->driverCommand(BaseConstants::$POST, $url);
    }

    /**
     * getWindowSize
     *
     * Get the size of the specified window.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getWindowSize($windowhandle)
    {
        $url = '/window/:windowhandle/size';
        $url = str_ireplace(':windowhandle', $windowhandle, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * postWindowPosition
     *
     * Change the position of the specified window.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function postWindowPosition($windowhandle)
    {
        $url = '/window/:windowhandle/position';
        $url = str_ireplace(':windowhandle', $windowhandle, $url);

        return $this->driverCommand(BaseConstants::$POST, $url);
    }

    /**
     * getWindowPosition
     *
     * Get the position of the specified window.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getWindowPosition($windowhandle)
    {
        $url = '/window/:windowhandle/position';
        $url = str_ireplace(':windowhandle', $windowhandle, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }


    /**
     * getCookies
     *
     * Retrieve all cookies visible to the current page.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getCookies()
    {
        return $this->driverCommand(BaseConstants::$GET, '/cookie');
    }

    /**
     * setCookie
     *
     * Set a cookie.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["cookie"]}
     *
     * @return mixed
     *
     **/
    public function setCookie($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/cookie', $data);
    }

    /**
     * deleteCookies
     *
     * Delete all cookies visible to the current page.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function deleteCookies()
    {
        return $this->driverCommand(BaseConstants::$DELETE, '/cookie');
    }

    /**
     * deleteCookie
     *
     * Delete the cookie with the given name.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function deleteCookie($name)
    {
        $url = '/cookie/:name';
        $url = str_ireplace(':name', $name, $url);

        return $this->driverCommand(BaseConstants::$DELETE, $url);
    }

    /**
     * getPageSource
     *
     * Get the current page source.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getPageSource()
    {
        return $this->driverCommand(BaseConstants::$GET, '/source');
    }

    /**
     * title
     *
     * Get the current page title.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function title()
    {
        return $this->driverCommand(BaseConstants::$GET, '/title');
    }

    /**
     * findElement
     *
     * Search for an element on the page, starting from the document root.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["using","value"]}
     *
     * @return mixed
     *
     **/
    public function findElement($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/element', $data);
    }

    /**
     * findElements
     *
     * Search for multiple elements on the page, starting from the document root.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["using","value"]}
     *
     * @return mixed
     *
     **/
    public function findElements($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/elements', $data);
    }

    /**
     * keys
     *
     * Send a sequence of key strokes to the active element.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["value"]}
     *
     * @return mixed
     *
     **/
    public function keys($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/keys', $data);
    }

    /**
     * getOrientation
     *
     * Get the current browser orientation.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getOrientation()
    {
        return $this->driverCommand(BaseConstants::$GET, '/orientation');
    }

    /**
     * setOrientation
     *
     * Set the browser orientation.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["orientation"]}
     *
     * @return mixed
     *
     **/
    public function setOrientation($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/orientation', $data);
    }

    /**
     * getAlertText
     *
     * Gets the text of the currently displayed JavaScript alert(), confirm(), or prompt() dialog.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getAlertText()
    {
        return $this->driverCommand(BaseConstants::$GET, '/alert_text');
    }

    /**
     * setAlertText
     *
     * Sends keystrokes to a JavaScript prompt() dialog.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["text"]}
     *
     * @return mixed
     *
     **/
    public function setAlertText($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/alert_text', $data);
    }

    /**
     * postAcceptAlert
     *
     * Accepts the currently displayed alert dialog.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function postAcceptAlert()
    {
        return $this->driverCommand(BaseConstants::$POST, '/accept_alert');
    }

    /**
     * postDismissAlert
     *
     * Dismisses the currently displayed alert dialog.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function postDismissAlert()
    {
        return $this->driverCommand(BaseConstants::$POST, '/dismiss_alert');
    }

    /**
     * moveTo
     *
     * Move the mouse by an offset of the specificed element.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"optional":["element","xoffset","yoffset"]}
     *
     * @return mixed
     *
     **/
    public function moveTo($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/moveto', $data);
    }

    /**
     * clickCurrent
     *
     * Click any mouse button (at the coordinates set by the last moveto command).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"optional":["button"]}
     *
     * @return mixed
     *
     **/
    public function clickCurrent($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/click', $data);
    }

    /**
     * postButtondown
     *
     * Click and hold the left mouse button (at the coordinates set by the last moveto command).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function postButtondown()
    {
        return $this->driverCommand(BaseConstants::$POST, '/buttondown');
    }

    /**
     * postButtonup
     *
     * Releases the mouse button previously held (where the mouse is currently at).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function postButtonup()
    {
        return $this->driverCommand(BaseConstants::$POST, '/buttonup');
    }

    /**
     * postDoubleclick
     *
     * Double-clicks at the current mouse coordinates (set by moveto).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function postDoubleclick()
    {
        return $this->driverCommand(BaseConstants::$POST, '/doubleclick');
    }

    /**
     * touchClick
     *
     * Single tap on the touch enabled device.
     *
     * @note   override mismatch jsonwire file
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["element"]}
     *
     * @return mixed
     *
     **/
    public function touchClick($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/touch/click', $data);
    }

    /**
     * touchDown
     *
     * Finger down on the screen.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["x","y"]}
     *
     * @return mixed
     *
     **/
    public function touchDown($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/touch/down', $data);
    }

    /**
     * touchUp
     *
     * Finger up on the screen.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["x","y"]}
     *
     * @return mixed
     *
     **/
    public function touchUp($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/touch/up', $data);
    }

    /**
     * touchMove
     *
     * Finger move on the screen.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["x","y"]}
     *
     * @return mixed
     *
     **/
    public function touchMove($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/touch/move', $data);
    }

    /**
     * postTouchScroll
     *
     * Scroll on the touch screen using finger based motion events.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function postTouchScroll()
    {
        return $this->driverCommand(BaseConstants::$POST, '/touch/scroll');
    }

    /**
     * postTouchDoubleclick
     *
     * Double tap on the touch screen using finger motion events.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function postTouchDoubleclick()
    {
        return $this->driverCommand(BaseConstants::$POST, '/touch/doubleclick');
    }

    /**
     * touchLongClick
     *
     * Long press on the touch screen using finger motion events.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["elements"]}
     *
     * @return mixed
     *
     **/
    public function touchLongClick($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/touch/longclick', $data);
    }

    /**
     * flick
     *
     * Flick on the touch screen using finger motion events.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"optional":["element","xspeed","yspeed","xoffset","yoffset","speed"]}
     *
     * @return mixed
     *
     **/
    public function flick($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/touch/flick', $data);
    }

    /**
     * getGeoLocation
     *
     * Get the current geo location.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getGeoLocation()
    {
        return $this->driverCommand(BaseConstants::$GET, '/location');
    }

    /**
     * setGeoLocation
     *
     * Set the current geo location.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["location"]}
     *
     * @return mixed
     *
     **/
    public function setGeoLocation($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/location', $data);
    }

    /**
     * getLocalStorage
     *
     * Get all keys of the storage.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getLocalStorage()
    {
        return $this->driverCommand(BaseConstants::$GET, '/local_storage');
    }

    /**
     * postLocalStorage
     *
     * Set the storage item for the given key.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function postLocalStorage()
    {
        return $this->driverCommand(BaseConstants::$POST, '/local_storage');
    }

    /**
     * deleteLocalStorage
     *
     * Clear the storage.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function deleteLocalStorage()
    {
        return $this->driverCommand(BaseConstants::$DELETE, '/local_storage');
    }

    /**
     * getLocalStorageKey
     *
     * Get the storage item for the given key.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getLocalStorageKey($key)
    {
        $url = '/local_storage/key/:key';
        $url = str_ireplace(':key', $key, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * deleteLocalStorageKey
     *
     * Remove the storage item for the given key.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function deleteLocalStorageKey($key)
    {
        $url = '/local_storage/key/:key';
        $url = str_ireplace(':key', $key, $url);

        return $this->driverCommand(BaseConstants::$DELETE, $url);
    }

    /**
     * getLocalStorageSize
     *
     * Get the number of items in the storage.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getLocalStorageSize()
    {
        return $this->driverCommand(BaseConstants::$GET, '/local_storage/size');
    }

    /**
     * getSessionStorage
     *
     * Get all keys of the storage.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getSessionStorage()
    {
        return $this->driverCommand(BaseConstants::$GET, '/session_storage');
    }

    /**
     * postSessionStorage
     *
     * Set the storage item for the given key.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function postSessionStorage()
    {
        return $this->driverCommand(BaseConstants::$POST, '/session_storage');
    }

    /**
     * deleteSessionStorage
     *
     * Clear the storage.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function deleteSessionStorage()
    {
        return $this->driverCommand(BaseConstants::$DELETE, '/session_storage');
    }

    /**
     * getSessionStorageKey
     *
     * Get the storage item for the given key.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getSessionStorageKey($key)
    {
        $url = '/session_storage/key/:key';
        $url = str_ireplace(':key', $key, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * deleteSessionStorageKey
     *
     * Remove the storage item for the given key.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function deleteSessionStorageKey($key)
    {
        $url = '/session_storage/key/:key';
        $url = str_ireplace(':key', $key, $url);

        return $this->driverCommand(BaseConstants::$DELETE, $url);
    }

    /**
     * getSessionStorageSize
     *
     * Get the number of items in the storage.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getSessionStorageSize()
    {
        return $this->driverCommand(BaseConstants::$GET, '/session_storage/size');
    }

    /**
     * getLog
     *
     * Get the log for a given log type.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["type"]}
     *
     * @return mixed
     *
     **/
    public function getLog($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/log', $data);
    }

    /**
     * getLogTypes
     *
     * Get available log types.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getLogTypes()
    {
        return $this->driverCommand(BaseConstants::$GET, '/log/types');
    }

    /**
     * getApplicationCacheStatus
     *
     * Get the status of the html5 application cache.
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getApplicationCacheStatus()
    {
        return $this->driverCommand(BaseConstants::$GET, '/application_cache/status');
    }

    /**
     * getCurrentContext
     *
     * Get the current context (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getCurrentContext()
    {
        return $this->driverCommand(BaseConstants::$GET, '/context');
    }

    /**
     * setContext
     *
     * Set the current context (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["name"]}
     *
     * @return mixed
     *
     **/
    public function setContext($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/context', $data);
    }

    /**
     * getContexts
     *
     * Get a list of the available contexts (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getContexts()
    {
        return $this->driverCommand(BaseConstants::$GET, '/contexts');
    }

    /**
     * performTouch
     *
     * Perform touch action (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["actions"]}
     *
     * @return mixed
     *
     **/
    public function performTouch($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/touch/perform', $data);
    }

    /**
     * performMultiAction
     *
     * Perform multitouch action (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["actions"],"optional":["elementId"]}
     *
     * @return mixed
     *
     **/
    public function performMultiAction($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/touch/multi/perform', $data);
    }

    /**
     * mobileShake
     *
     * Shake device (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function mobileShake()
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/shake');
    }

    /**
     * lock
     *
     * Lock device (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"optional":["seconds"]}
     *
     * @return mixed
     *
     **/
    public function lock($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/lock', $data);
    }

    /**
     * keyevent
     *
     * Send key event to device (DEPRECATED) (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["keycode"],"optional":["metastate"]}
     *
     * @return mixed
     *
     **/
    public function keyevent($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/keyevent', $data);
    }

    /**
     * pressKeyCode
     *
     * Send key event to device (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["keycode"],"optional":["metastate"]}
     *
     * @return mixed
     *
     **/
    public function pressKeyCode($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/press_keycode', $data);
    }

    /**
     * mobileRotation
     *
     * Rotate device (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["x","y","radius","rotation","touchCount","duration"],"optional":["element"]}
     *
     * @return mixed
     *
     **/
    public function mobileRotation($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/rotate', $data);
    }

    /**
     * getCurrentActivity
     *
     * Get current activity (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getCurrentActivity()
    {
        return $this->driverCommand(BaseConstants::$GET, '/appium/device/current_activity');
    }

    /**
     * getCurrentPackage
     *
     * Get current package (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getCurrentPackage()
    {
        return $this->driverCommand(BaseConstants::$GET, '/appium/device/current_package');
    }

    /**
     * installApp
     *
     * Install app (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["appPath"],"optional":["options"]}
     *
     * @return mixed
     *
     **/
    public function installApp($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/install_app', $data);
    }

    /**
     * removeApp
     *
     * Remove app (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":[["appId"],["bundleId"]],"optional":["options"]}
     *
     * @return mixed
     *
     **/
    public function removeApp($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/remove_app', $data);
    }

    /**
     * isAppInstalled
     *
     * Check if the app is installed (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":[["appId"],["bundleId"]]}
     *
     * @return mixed
     *
     **/
    public function isAppInstalled($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/app_installed', $data);
    }

    /**
     * pushFile
     *
     * Push file to device (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["path","data"]}
     *
     * @return mixed
     *
     **/
    public function pushFile($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/push_file', $data);
    }

    /**
     * pullFile
     *
     * Pull file from device (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["path"]}
     *
     * @return mixed
     *
     **/
    public function pullFile($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/pull_file', $data);
    }

    /**
     * pullFolder
     *
     * Pull folder from device (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["path"]}
     *
     * @return mixed
     *
     **/
    public function pullFolder($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/pull_folder', $data);
    }

    /**
     * toggleFlightMode
     *
     * Toggle airplane mode (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function toggleFlightMode()
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/toggle_airplane_mode');
    }

    /**
     * toggleWiFi
     *
     * Toggle wifi (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function toggleWiFi()
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/toggle_wifi');
    }

    /**
     * toggleLocationServices
     *
     * Toggle location services (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function toggleLocationServices()
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/toggle_location_services');
    }

    /**
     * toggleData
     *
     * Toggle data (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function toggleData()
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/toggle_data');
    }

    /**
     * startActivity
     *
     * Start an Android activity (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["appPackage","appActivity"],"optional":["appWaitPackage","appWaitActivity","intentAction","intentCategory","intentFlags","optionalIntentArguments","dontStopAppOnReset"]}
     *
     * @return mixed
     *
     **/
    public function startActivity($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/start_activity', $data);
    }

    /**
     * launchApp
     *
     * Launch app (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function launchApp()
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/app/launch');
    }

    /**
     * closeApp
     *
     * Close app (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function closeApp()
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/app/close');
    }

    /**
     * reset
     *
     * Reset app (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function reset()
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/app/reset');
    }

    /**
     * background
     *
     * Background app (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["seconds"]}
     *
     * @return mixed
     *
     **/
    public function background($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/app/background', $data);
    }

    /**
     * endCoverage
     *
     * End test coverage (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["intent","path"]}
     *
     * @return mixed
     *
     **/
    public function endCoverage($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/app/end_test_coverage', $data);
    }

    /**
     * getStrings
     *
     * Retrieve app strings (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"optional":["language","stringFile"]}
     *
     * @return mixed
     *
     **/
    public function getStrings($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/app/strings', $data);
    }

    /**
     * getNetworkConnection
     *
     * Get appium selendroid network connection type (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getNetworkConnection()
    {
        return $this->driverCommand(BaseConstants::$GET, '/network_connection');
    }

    /**
     * setNetworkConnection
     *
     * Set appium selendroid network connection type (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["type"]}
     *
     * @return mixed
     *
     **/
    public function setNetworkConnection($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/network_connection', $data);
    }

    /**
     * hideKeyboard
     *
     * Hide keyboard (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"optional":["strategy","key","keyCode","keyName"]}
     *
     * @return mixed
     *
     **/
    public function hideKeyboard($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/hide_keyboard', $data);
    }

    /**
     * openNotifications
     *
     * Open Notifications (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function openNotifications()
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/open_notifications');
    }

    /**
     * fingerprint
     *
     * Send fingerprint (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["fingerprintId"]}
     *
     * @return mixed
     *
     **/
    public function fingerprint($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/finger_print', $data);
    }

    /**
     * sendSMS
     *
     * Send sms to Android emulator (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["phoneNumber","message"]}
     *
     * @return mixed
     *
     **/
    public function sendSMS($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/send_sms', $data);
    }

    /**
     * gsmCall
     *
     * Send GSM call to Android emulator (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["phoneNumber","action"]}
     *
     * @return mixed
     *
     **/
    public function gsmCall($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/gsm_call', $data);
    }

    /**
     * gsmSignal
     *
     * Set GSM signal strenght on Android emulator (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["signalStrengh"]}
     *
     * @return mixed
     *
     **/
    public function gsmSignal($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/gsm_signal', $data);
    }

    /**
     * gsmVoice
     *
     * Set GSM state  fingerprint (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["state"]}
     *
     * @return mixed
     *
     **/
    public function gsmVoice($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/gsm_voice', $data);
    }

    /**
     * powerCapacity
     *
     * Set battery percent on Android emulator (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["percent"]}
     *
     * @return mixed
     *
     **/
    public function powerCapacity($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/power_capacity', $data);
    }

    /**
     * powerAC
     *
     * Set state of power charger on Android emulator(mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["state"]}
     *
     * @return mixed
     *
     **/
    public function powerAC($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/power_ac', $data);
    }

    /**
     * networkSpeed
     *
     * Set Android emulator network speed (mjsonWire).
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["netspeed"]}
     *
     * @return mixed
     *
     **/
    public function networkSpeed($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/network_speed', $data);
    }

    /**
     * touchId
     *
     * Simulate iOS touchID (mjsonWire)
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["match"]}
     *
     * @return mixed
     *
     **/
    public function touchId($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/simulator/touch_id', $data);
    }

    /**
     * getTimeouts
     *
     * get /wd/hub/session/:sessionid/timeouts
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getTimeouts()
    {
        return $this->driverCommand(BaseConstants::$GET, '/timeouts');
    }

    /**
     * postFrameParent
     *
     * post /wd/hub/session/:sessionid/frame/parent
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function postFrameParent()
    {
        return $this->driverCommand(BaseConstants::$POST, '/frame/parent');
    }

    /**
     * getCookie
     *
     * get /wd/hub/session/:sessionid/cookie/:name
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getCookie($name)
    {
        $url = '/cookie/:name';
        $url = str_ireplace(':name', $name, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * active
     *
     * get /wd/hub/session/:sessionid/element/active
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function active()
    {
        return $this->driverCommand(BaseConstants::$GET, '/element/active');
    }

    /**
     * getElement
     *
     * get /wd/hub/session/:sessionid/element/:elementid
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getElement($elementid)
    {
        $url = '/element/:elementid';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * findElementFromElement
     *
     * post /wd/hub/session/:sessionid/element/:elementid/element
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["using","value"]}
     *
     * @return mixed
     *
     **/
    public function findElementFromElement($data, $elementid)
    {
        $url = '/element/:elementid/element';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$POST, $url, $data);
    }

    /**
     * findElementsFromElement
     *
     * post /wd/hub/session/:sessionid/element/:elementid/elements
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["using","value"]}
     *
     * @return mixed
     *
     **/
    public function findElementsFromElement($data, $elementid)
    {
        $url = '/element/:elementid/elements';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$POST, $url, $data);
    }

    /**
     * click
     *
     * post /wd/hub/session/:sessionid/element/:elementid/click
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function click($elementid)
    {
        $url = '/element/:elementid/click';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$POST, $url);
    }

    /**
     * submit
     *
     * post /wd/hub/session/:sessionid/element/:elementid/submit
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function submit($elementid)
    {
        $url = '/element/:elementid/submit';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$POST, $url);
    }

    /**
     * getText
     *
     * get /wd/hub/session/:sessionid/element/:elementid/text
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getText($elementid)
    {
        $url = '/element/:elementid/text';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * setValue
     *
     * post /wd/hub/session/:sessionid/element/:elementid/value
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"optional":["value","text"]}
     *
     * @return mixed
     *
     **/
    public function setValue($data, $elementid)
    {
        $url = '/element/:elementid/value';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$POST, $url, $data);
    }

    /**
     * getName
     *
     * get /wd/hub/session/:sessionid/element/:elementid/name
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getName($elementid)
    {
        $url = '/element/:elementid/name';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * clear
     *
     * post /wd/hub/session/:sessionid/element/:elementid/clear
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function clear($elementid)
    {
        $url = '/element/:elementid/clear';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$POST, $url);
    }

    /**
     * elementSelected
     *
     * get /wd/hub/session/:sessionid/element/:elementid/selected
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function elementSelected($elementid)
    {
        $url = '/element/:elementid/selected';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * elementEnabled
     *
     * get /wd/hub/session/:sessionid/element/:elementid/enabled
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function elementEnabled($elementid)
    {
        $url = '/element/:elementid/enabled';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * getAttribute
     *
     * get /wd/hub/session/:sessionid/element/:elementid/attribute/:name
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getAttribute($elementid, $name)
    {
        $url = '/element/:elementid/attribute/:name';
        $url = str_ireplace(':elementid', $elementid, $url);
        $url = str_ireplace(':name', $name, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * equalsElement
     *
     * get /wd/hub/session/:sessionid/element/:elementid/equals/:otherid
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function equalsElement($elementid, $otherid)
    {
        $url = '/element/:elementid/equals/:otherid';
        $url = str_ireplace(':elementid', $elementid, $url);
        $url = str_ireplace(':otherid', $otherid, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * elementDisplayed
     *
     * get /wd/hub/session/:sessionid/element/:elementid/displayed
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function elementDisplayed($elementid)
    {
        $url = '/element/:elementid/displayed';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * getLocation
     *
     * get /wd/hub/session/:sessionid/element/:elementid/location
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getLocation($elementid)
    {
        $url = '/element/:elementid/location';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * getLocationInView
     *
     * get /wd/hub/session/:sessionid/element/:elementid/location_in_view
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getLocationInView($elementid)
    {
        $url = '/element/:elementid/location_in_view';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * getSize
     *
     * get /wd/hub/session/:sessionid/element/:elementid/size
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getSize($elementid)
    {
        $url = '/element/:elementid/size';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * getCssProperty
     *
     * get /wd/hub/session/:sessionid/element/:elementid/css/:propertyname
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getCssProperty($elementid, $propertyname)
    {
        $url = '/element/:elementid/css/:propertyname';
        $url = str_ireplace(':elementid', $elementid, $url);
        $url = str_ireplace(':propertyname', $propertyname, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * getRotation
     *
     * get /wd/hub/session/:sessionid/rotation
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getRotation()
    {
        return $this->driverCommand(BaseConstants::$GET, '/rotation');
    }

    /**
     * setRotation
     *
     * post /wd/hub/session/:sessionid/rotation
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["x","y","z"]}
     *
     * @return mixed
     *
     **/
    public function setRotation($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/rotation', $data);
    }

    /**
     * performActions
     *
     * post /wd/hub/session/:sessionid/actions
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["actions"]}
     *
     * @return mixed
     *
     **/
    public function performActions($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/actions', $data);
    }

    /**
     * getPageIndex
     *
     * get /wd/hub/session/:sessionid/element/:elementid/pageindex
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getPageIndex($elementid)
    {
        $url = '/element/:elementid/pageindex';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * receiveAsyncResponse
     *
     * post /wd/hub/session/:sessionid/receive_async_response
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["status","value"]}
     *
     * @return mixed
     *
     **/
    public function receiveAsyncResponse($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/receive_async_response', $data);
    }

    /**
     * getDeviceTime
     *
     * get /wd/hub/session/:sessionid/appium/device/system_time
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getDeviceTime()
    {
        return $this->driverCommand(BaseConstants::$GET, '/appium/device/system_time');
    }

    /**
     * unlock
     *
     * post /wd/hub/session/:sessionid/appium/device/unlock
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function unlock()
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/unlock');
    }

    /**
     * isLocked
     *
     * post /wd/hub/session/:sessionid/appium/device/is_locked
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function isLocked()
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/is_locked');
    }

    /**
     * startRecordingScreen
     *
     * post /wd/hub/session/:sessionid/appium/start_recording_screen
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"optional":["options"]}
     *
     * @return mixed
     *
     **/
    public function startRecordingScreen($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/start_recording_screen', $data);
    }

    /**
     * stopRecordingScreen
     *
     * post /wd/hub/session/:sessionid/appium/stop_recording_screen
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"optional":["options"]}
     *
     * @return mixed
     *
     **/
    public function stopRecordingScreen($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/stop_recording_screen', $data);
    }

    /**
     * getPerformanceDataTypes
     *
     * post /wd/hub/session/:sessionid/appium/performancedata/types
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getPerformanceDataTypes()
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/performancedata/types');
    }

    /**
     * getPerformanceData
     *
     * post /wd/hub/session/:sessionid/appium/getperformancedata
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["packageName","dataType"],"optional":["dataReadTimeout"]}
     *
     * @return mixed
     *
     **/
    public function getPerformanceData($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/performancedata', $data);
    }

    /**
     * longPressKeyCode
     *
     * post /wd/hub/session/:sessionid/appium/device/long_press_keycode
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["keycode"],"optional":["metastate"]}
     *
     * @return mixed
     *
     **/
    public function longPressKeyCode($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/long_press_keycode', $data);
    }

    /**
     * activateApp
     *
     * post /wd/hub/session/:sessionid/appium/device/activate_app
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":[["appId"],["bundleId"]],"optional":["options"]}
     *
     * @return mixed
     *
     **/
    public function activateApp($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/activate_app', $data);
    }

    /**
     * terminateApp
     *
     * post /wd/hub/session/:sessionid/appium/device/terminate_app
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":[["appId"],["bundleId"]],"optional":["options"]}
     *
     * @return mixed
     *
     **/
    public function terminateApp($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/terminate_app', $data);
    }

    /**
     * queryAppState
     *
     * get /wd/hub/session/:sessionid/appium/device/app_state
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":[["appId"],["bundleId"]]}
     *
     * @return mixed
     *
     **/
    public function queryAppState($data)
    {
        return $this->driverCommand(BaseConstants::$GET, '/appium/device/app_state', $data);
    }

    /**
     * isKeyboardShown
     *
     * get /wd/hub/session/:sessionid/appium/device/is_keyboard_shown
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function isKeyboardShown()
    {
        return $this->driverCommand(BaseConstants::$GET, '/appium/device/is_keyboard_shown');
    }

    /**
     * getSystemBars
     *
     * get /wd/hub/session/:sessionid/appium/device/system_bars
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getSystemBars()
    {
        return $this->driverCommand(BaseConstants::$GET, '/appium/device/system_bars');
    }

    /**
     * getDisplayDensity
     *
     * get /wd/hub/session/:sessionid/appium/device/display_density
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getDisplayDensity()
    {
        return $this->driverCommand(BaseConstants::$GET, '/appium/device/display_density');
    }

    /**
     * simulatorTouchId
     *
     * post /wd/hub/session/:sessionid/appium/simulator/touch_id
     *
     * @note   override mismatch jsonwire file
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["match"]}
     *
     * @return mixed
     *
     **/
    public function simulatorTouchId($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/simulator/touch_id', $data);
    }

    /**
     * toggleEnrollTouchId
     *
     * post /wd/hub/session/:sessionid/appium/simulator/toggle_touch_id_enrollment
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"optional":["enabled"]}
     *
     * @return mixed
     *
     **/
    public function toggleEnrollTouchId($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/simulator/toggle_touch_id_enrollment', $data);
    }

    /**
     * setValueImmediate
     *
     * post /wd/hub/session/:sessionid/appium/element/:elementid/value
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["value"]}
     *
     * @return mixed
     *
     **/
    public function setValueImmediate($data, $elementid)
    {
        $url = '/appium/element/:elementid/value';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$POST, $url, $data);
    }

    /**
     * replaceValue
     *
     * post /wd/hub/session/:sessionid/appium/element/:elementid/replace_value
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["value"]}
     *
     * @return mixed
     *
     **/
    public function replaceValue($data, $elementid)
    {
        $url = '/appium/element/:elementid/replace_value';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$POST, $url, $data);
    }

    /**
     * updateSettings
     *
     * post /wd/hub/session/:sessionid/appium/settings
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["settings"]}
     *
     * @return mixed
     *
     **/
    public function updateSettings($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/settings', $data);
    }

    /**
     * getSettings
     *
     * get /wd/hub/session/:sessionid/appium/settings
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getSettings()
    {
        return $this->driverCommand(BaseConstants::$GET, '/appium/settings');
    }

    /**
     * appReceiveAsyncResponse
     *
     * post /wd/hub/session/:sessionid/appium/receive_async_response
     *
     * @note   override same command name in route.js
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["response"]}
     *
     * @return mixed
     *
     **/
    public function appReceiveAsyncResponse($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/receive_async_response', $data);
    }

    /**
     * getAlertTextEx
     *
     * get /wd/hub/session/:sessionid/alert/text
     *
     * @note   override same command name in route.js
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getAlertTextEx()
    {
        return $this->driverCommand(BaseConstants::$GET, '/alert/text');
    }

    /**
     * setAlertTextEx
     *
     * post /wd/hub/session/:sessionid/alert/text
     *
     * @note   override same command name in route.js
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     * @param array $data
     * @options {"required":["text"]}
     *
     * @return mixed
     *
     **/
    public function setAlertTextEx($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/alert/text', $data);
    }

    /**
     * postAcceptAlertEx
     *
     * post /wd/hub/session/:sessionid/alert/accept
     *
     * @note   override same command name in route.js
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function postAcceptAlertEx()
    {
        return $this->driverCommand(BaseConstants::$POST, '/alert/accept');
    }

    /**
     * postDismissAlertEx
     *
     * post /wd/hub/session/:sessionid/alert/dismiss
     *
     * @note   override same command name in route.js
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function postDismissAlertEx()
    {
        return $this->driverCommand(BaseConstants::$POST, '/alert/dismiss');
    }

    /**
     * getElementRect
     *
     * get /wd/hub/session/:sessionid/element/:elementid/rect
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getElementRect($elementid)
    {
        $url = '/element/:elementid/rect';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * getElementScreenshot
     *
     * get /wd/hub/session/:sessionid/element/:elementid/screenshot
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getElementScreenshot($elementid)
    {
        $url = '/element/:elementid/screenshot';
        $url = str_ireplace(':elementid', $elementid, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * getWindowRect
     *
     * get /wd/hub/session/:sessionid/window/rect
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getWindowRect()
    {
        return $this->driverCommand(BaseConstants::$GET, '/window/rect');
    }

    /**
     * setWindowRect
     *
     * post /wd/hub/session/:sessionid/window/rect
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function setWindowRect()
    {
        return $this->driverCommand(BaseConstants::$POST, '/window/rect');
    }

    /**
     * maximizeWindow
     *
     * NOTE: Discard the duplicate function maximizeWindow($windowhandle) as that is legacy.
     *
     * Maximize the specified window if not already maximized.
     * post /wd/hub/session/:sessionid/window/maximize
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function maximizeWindow()
    {
        return $this->driverCommand(BaseConstants::$POST, '/window/maximize');
    }

    /**
     * minimizeWindow
     *
     * post /wd/hub/session/:sessionid/window/minimize
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function minimizeWindow()
    {
        return $this->driverCommand(BaseConstants::$POST, '/window/minimize');
    }

    /**
     * fullScreenWindow
     *
     * post /wd/hub/session/:sessionid/window/fullscreen
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function fullScreenWindow()
    {
        return $this->driverCommand(BaseConstants::$POST, '/window/fullscreen');
    }

    /**
     * getProperty
     *
     * get /wd/hub/session/:sessionid/element/:elementid/property/:name
     *
     * @link   https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     *
     **/
    public function getProperty($elementid, $name)
    {
        $url = '/element/:elementid/property/:name';
        $url = str_ireplace(':elementid', $elementid, $url);
        $url = str_ireplace(':name', $name, $url);

        return $this->driverCommand(BaseConstants::$GET, $url);
    }

    /**
     * setClipboard
     *
     * post /wd/hub/session/:sessionid/appium/device/set_clipboard
     * @link https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     * @param array $data
     * options {"required":["content"],"optional":["contentType","label"]}
     *
     * @return mixed
     *
     **/
    public function setClipboard($data)
    {
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/set_clipboard', $data);
    }

    /**
     * getClipboard
     *
     * post /wd/hub/session/:sessionid/appium/device/get_clipboard
     * @link https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     * @param array $data
     * @options {"optional":["contentType"]}
     *
     * @return mixed
     *
     **/
    public function getClipboard($data){
        return $this->driverCommand(BaseConstants::$POST, '/appium/device/_clipboard', $data);
    }

    /**
     * compareImages
     *
     * post /wd/hub/session/:sessionid/appium/compare_images
     * @link https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js
     * @source route.json
     * @param array $data
     * @options {"required":["mode","firstImage","secondImage"],"optional":["options"]}
     *
     * @return mixed
     *
     **/
    public function compareImages($data){
        return $this->driverCommand(BaseConstants::$POST, '/appium/compare_images', $data);
    }
}
