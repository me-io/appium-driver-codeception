# Codeception appium driver

## Install

Include codeception appium driver in the composer.json file:

```json
{
    "require": {
        "tajawal/codeception-appium": "~1"
    }
}
```

Run composer update:

```bash
composer update
```

This will install codeception appium driver and all dependencies. 
Enable module in your suite yml file:

```yaml
modules:
  enabled:
    ...
    - \Appium\AppiumDriver
```

Run build codeception command and you are good to go:

```bash
codecept build
```

## Configure

Add next configuration in the yml file to configure your driver:

```yaml
config:
    \Appium\AppiumDriver:
      host: 10.0.2.2
      port: 4723
      dummyRemote: false
      ## before suite / ios / android
      resetAfterSuite: true
      ## before scenarios
      resetAfterCest: false
      ## before every test
      resetAfterTest: false
      ## before every step
      resetAfterStep: false
      capabilities:
        app             : '/your_app/example.zip'
        platformName    : 'iOS'
        platformVersion : '9.3'
        deviceName      : 'iPhone 5'
        #automationName  : 'XCUITest'
        fullReset       : false
        noReset         : true
        newCommandTimeout: 7200
        #sessionOverride : true
        #orientation: PORTRAIT
        #browserName: Safari
        #language: ar
        #locale: ar-sa
        #udid: 123456
        #autoWebview: false
```
[comment]: # (extra-function-comment)

[comment]: # (extra-function-comment)
[comment]: # (core-function-comment)

| MethodName                | Method | Url                                          | Description                                        | Payload                                            |
| ------------------------- | ------ | -------------------------------------------- | -------------------------------------------------- | -------------------------------------------------- |
| getStatus                 | GET    | /status                                      | Query the server's current status.                 |                                                    |
| createSession             | POST   | /session                                     | Create a new session.                              | {"optional":["desiredCapabilities","requiredCap... |
| getSessions               | GET    | /sessions                                    | Returns a list of the currently active sessions.   |                                                    |
| getSession                | GET    |                                              | Retrieve the capabilities of the specified sess... |                                                    |
| deleteSession             | DELETE |                                              | Delete the session.                                |                                                    |
| timeouts                  | POST   | /timeouts                                    | Configure the amount of time that a particular ... | {"required":["type","ms"]}                         |
| asyncScriptTimeout        | POST   | /timeouts/async_script                       | Set the amount of time, in milliseconds, that a... | {"required":["ms"]}                                |
| implicitWait              | POST   | /timeouts/implicit_wait                      | Set the amount of time the driver should wait w... | {"required":["ms"]}                                |
| getWindowHandle           | GET    | /window_handle                               | Retrieve the current window handle.                |                                                    |
| getWindowHandles          | GET    | /window_handles                              | Retrieve the list of all window handles availab... |                                                    |
| getUrl                    | GET    | /url                                         | Retrieve the URL of the current page.              |                                                    |
| setUrl                    | POST   | /url                                         | Navigate to a new URL.                             | {"required":["url"]}                               |
| forward                   | POST   | /forward                                     | Navigate forwards in the browser history, if po... |                                                    |
| back                      | POST   | /back                                        | Navigate backwards in the browser history, if p... |                                                    |
| refresh                   | POST   | /refresh                                     | Refresh the current page.                          |                                                    |
| execute                   | POST   | /execute                                     | Inject a snippet of JavaScript into the page fo... | {"required":["script","args"]}                     |
| executeAsync              | POST   | /execute_async                               | Inject a snippet of JavaScript into the page fo... | {"required":["script","args"]}                     |
| getScreenshot             | GET    | /screenshot                                  | Take a screenshot of the current page.             |                                                    |
| availableIMEEngines       | GET    | /ime/available_engines                       | List all available engines on the machine.         |                                                    |
| getActiveIMEEngine        | GET    | /ime/active_engine                           | Get the name of the active IME engine.             |                                                    |
| isIMEActivated            | GET    | /ime/activated                               | Indicates whether IME input is active at the mo... |                                                    |
| deactivateIMEEngine       | POST   | /ime/deactivate                              | De-activates the currently-active IME engine.      |                                                    |
| activateIMEEngine         | POST   | /ime/activate                                | Make an engines that is available (appears on t... | {"required":["engine"]}                            |
| setFrame                  | POST   | /frame                                       | Change focus to another frame on the page.         | {"required":["id"]}                                |
| setWindow                 | POST   | /window                                      | Change focus to another window.                    | {"required":["name"]}                              |
| closeWindow               | DELETE | /window                                      | Close the current window.                          |                                                    |
| postWindowSize            | POST   | /window/:windowhandle/size                   | Change the size of the specified window.           |                                                    |
| getWindowSize             | GET    | /window/:windowhandle/size                   | Get the size of the specified window.              |                                                    |
| postWindowPosition        | POST   | /window/:windowhandle/position               | Change the position of the specified window.       |                                                    |
| getWindowPosition         | GET    | /window/:windowhandle/position               | Get the position of the specified window.          |                                                    |
| maximizeWindow            | POST   | /window/:windowhandle/maximize               | Maximize the specified window if not already ma... |                                                    |
| getCookies                | GET    | /cookie                                      | Retrieve all cookies visible to the current page.  |                                                    |
| setCookie                 | POST   | /cookie                                      | Set a cookie.                                      | {"required":["cookie"]}                            |
| deleteCookies             | DELETE | /cookie                                      | Delete all cookies visible to the current page.    |                                                    |
| deleteCookie              | DELETE | /cookie/:name                                | Delete the cookie with the given name.             |                                                    |
| getPageSource             | GET    | /source                                      | Get the current page source.                       |                                                    |
| title                     | GET    | /title                                       | Get the current page title.                        |                                                    |
| findElement               | POST   | /element                                     | Search for an element on the page, starting fro... | {"required":["using","value"]}                     |
| findElements              | POST   | /elements                                    | Search for multiple elements on the page, start... | {"required":["using","value"]}                     |
| active                    | POST   | /element/active                              | Get the element on the page that currently has ... |                                                    |
| keys                      | POST   | /keys                                        | Send a sequence of key strokes to the active el... | {"required":["value"]}                             |
| getOrientation            | GET    | /orientation                                 | Get the current browser orientation.               |                                                    |
| setOrientation            | POST   | /orientation                                 | Set the browser orientation.                       | {"required":["orientation"]}                       |
| getAlertText              | GET    | /alert_text                                  | Gets the text of the currently displayed JavaSc... |                                                    |
| setAlertText              | POST   | /alert_text                                  | Sends keystrokes to a JavaScript prompt() dialog.  | {"required":["text"]}                              |
| postAcceptAlert           | POST   | /accept_alert                                | Accepts the currently displayed alert dialog.      |                                                    |
| postDismissAlert          | POST   | /dismiss_alert                               | Dismisses the currently displayed alert dialog.    |                                                    |
| moveTo                    | POST   | /moveto                                      | Move the mouse by an offset of the specificed e... | {"optional":["element","xoffset","yoffset"]}       |
| clickCurrent              | POST   | /click                                       | Click any mouse button (at the coordinates set ... | {"optional":["button"]}                            |
| postButtondown            | POST   | /buttondown                                  | Click and hold the left mouse button (at the co... |                                                    |
| postButtonup              | POST   | /buttonup                                    | Releases the mouse button previously held (wher... |                                                    |
| postDoubleclick           | POST   | /doubleclick                                 | Double-clicks at the current mouse coordinates ... |                                                    |
| touchClick                | POST   | /touch/click                                 | Single tap on the touch enabled device.            | {"required":["element"]}                           |
| touchDown                 | POST   | /touch/down                                  | Finger down on the screen.                         | {"required":["x","y"]}                             |
| touchUp                   | POST   | /touch/up                                    | Finger up on the screen.                           | {"required":["x","y"]}                             |
| touchMove                 | POST   | /touch/move                                  | Finger move on the screen.                         | {"required":["x","y"]}                             |
| postTouchScroll           | POST   | /touch/scroll                                | Scroll on the touch screen using finger based m... |                                                    |
| postTouchDoubleclick      | POST   | /touch/doubleclick                           | Double tap on the touch screen using finger mot... |                                                    |
| touchLongClick            | POST   | /touch/longclick                             | Long press on the touch screen using finger mot... | {"required":["elements"]}                          |
| flick                     | POST   | /touch/flick                                 | Flick on the touch screen using finger motion e... | {"optional":["element","xspeed","yspeed","xoffs... |
| getGeoLocation            | GET    | /location                                    | Get the current geo location.                      |                                                    |
| setGeoLocation            | POST   | /location                                    | Set the current geo location.                      | {"required":["location"]}                          |
| getLocalStorage           | GET    | /local_storage                               | Get all keys of the storage.                       |                                                    |
| postLocalStorage          | POST   | /local_storage                               | Set the storage item for the given key.            |                                                    |
| deleteLocalStorage        | DELETE | /local_storage                               | Clear the storage.                                 |                                                    |
| getLocalStorageKey        | GET    | /local_storage/key/:key                      | Get the storage item for the given key.            |                                                    |
| deleteLocalStorageKey     | DELETE | /local_storage/key/:key                      | Remove the storage item for the given key.         |                                                    |
| getLocalStorageSize       | GET    | /local_storage/size                          | Get the number of items in the storage.            |                                                    |
| getSessionStorage         | GET    | /session_storage                             | Get all keys of the storage.                       |                                                    |
| postSessionStorage        | POST   | /session_storage                             | Set the storage item for the given key.            |                                                    |
| deleteSessionStorage      | DELETE | /session_storage                             | Clear the storage.                                 |                                                    |
| getSessionStorageKey      | GET    | /session_storage/key/:key                    | Get the storage item for the given key.            |                                                    |
| deleteSessionStorageKey   | DELETE | /session_storage/key/:key                    | Remove the storage item for the given key.         |                                                    |
| getSessionStorageSize     | GET    | /session_storage/size                        | Get the number of items in the storage.            |                                                    |
| getLog                    | POST   | /log                                         | Get the log for a given log type.                  | {"required":["type"]}                              |
| getLogTypes               | GET    | /log/types                                   | Get available log types.                           |                                                    |
| getApplicationCacheStatus | GET    | /application_cache/status                    | Get the status of the html5 application cache.     |                                                    |
| getCurrentContext         | GET    | /context                                     | Get the current context (mjsonWire).               |                                                    |
| setContext                | POST   | /context                                     | Set the current context (mjsonWire).               | {"required":["name"]}                              |
| getContexts               | GET    | /contexts                                    | Get a list of the available contexts (mjsonWire).  |                                                    |
| performTouch              | POST   | /touch/perform                               | Perform touch action (mjsonWire).                  | {"required":["actions"]}                           |
| performMultiAction        | POST   | /touch/multi/perform                         | Perform multitouch action (mjsonWire).             | {"required":["actions"],"optional":["elementId"]}  |
| mobileShake               | POST   | /appium/device/shake                         | Shake device (mjsonWire).                          |                                                    |
| lock                      | POST   | /appium/device/lock                          | Lock device (mjsonWire).                           | {"optional":["seconds"]}                           |
| keyevent                  | POST   | /appium/device/keyevent                      | Send key event to device (DEPRECATED) (mjsonWire). | {"required":["keycode"],"optional":["metastate"]}  |
| pressKeyCode              | POST   | /appium/device/press_keycode                 | Send key event to device (mjsonWire).              | {"required":["keycode"],"optional":["metastate"]}  |
| mobileRotation            | POST   | /appium/device/rotate                        | Rotate device (mjsonWire).                         | {"required":["x","y","radius","rotation","touch... |
| getCurrentActivity        | GET    | /appium/device/current_activity              | Get current activity (mjsonWire).                  |                                                    |
| getCurrentPackage         | GET    | /appium/device/current_package               | Get current package (mjsonWire).                   |                                                    |
| installApp                | POST   | /appium/device/install_app                   | Install app (mjsonWire).                           | {"required":["appPath"]}                           |
| removeApp                 | POST   | /appium/device/remove_app                    | Remove app (mjsonWire).                            | {"required":[["appId"],["bundleId"]]}              |
| isAppInstalled            | POST   | /appium/device/app_installed                 | Check if the app is installed (mjsonWire).         | {"required":["bundleId"]}                          |
| pushFile                  | POST   | /appium/device/push_file                     | Push file to device (mjsonWire).                   | {"required":["path","data"]}                       |
| pullFile                  | POST   | /appium/device/pull_file                     | Pull file from device (mjsonWire).                 | {"required":["path"]}                              |
| pullFolder                | POST   | /appium/device/pull_folder                   | Pull folder from device (mjsonWire).               | {"required":["path"]}                              |
| toggleFlightMode          | POST   | /appium/device/toggle_airplane_mode          | Toggle airplane mode (mjsonWire).                  |                                                    |
| toggleWiFi                | POST   | /appium/device/toggle_wifi                   | Toggle wifi (mjsonWire).                           |                                                    |
| toggleLocationServices    | POST   | /appium/device/toggle_location_services      | Toggle location services (mjsonWire).              |                                                    |
| toggleData                | POST   | /appium/device/toggle_data                   | Toggle data (mjsonWire).                           |                                                    |
| startActivity             | POST   | /appium/device/start_activity                | Start an Android activity (mjsonWire).             | {"required":["appPackage","appActivity"],"optio... |
| launchApp                 | POST   | /appium/app/launch                           | Launch app (mjsonWire).                            |                                                    |
| closeApp                  | POST   | /appium/app/close                            | Close app (mjsonWire).                             |                                                    |
| reset                     | POST   | /appium/app/reset                            | Reset app (mjsonWire).                             |                                                    |
| background                | POST   | /appium/app/background                       | Background app (mjsonWire).                        | {"required":["seconds"]}                           |
| endCoverage               | POST   | /appium/app/end_test_coverage                | End test coverage (mjsonWire).                     | {"required":["intent","path"]}                     |
| getStrings                | POST   | /appium/app/strings                          | Retrieve app strings (mjsonWire).                  | {"optional":["language","stringFile"]}             |
| getNetworkConnection      | GET    | /network_connection                          | Get appium selendroid network connection type (... |                                                    |
| setNetworkConnection      | POST   | /network_connection                          | Set appium selendroid network connection type (... | {"required":["type"]}                              |
| hideKeyboard              | POST   | /appium/device/hide_keyboard                 | Hide keyboard (mjsonWire).                         | {"optional":["strategy","key","keyCode","keyNam... |
| openNotifications         | POST   | /appium/device/open_notifications            | Open Notifications (mjsonWire).                    |                                                    |
| fingerprint               | POST   | /appium/device/finger_print                  | Send fingerprint (mjsonWire).                      | {"required":["fingerprintId"]}                     |
| sendSMS                   | POST   | /appium/device/send_sms                      | Send sms to Android emulator (mjsonWire).          | {"required":["phoneNumber","message"]}             |
| gsmCall                   | POST   | /appium/device/gsm_call                      | Send GSM call to Android emulator (mjsonWire).     | {"required":["phoneNumber","action"]}              |
| gsmSignal                 | POST   | /appium/device/gsm_signal                    | Set GSM signal strenght on Android emulator (mj... | {"required":["signalStrengh"]}                     |
| gsmVoice                  | POST   | /appium/device/gsm_voice                     | Set GSM state  fingerprint (mjsonWire).            | {"required":["state"]}                             |
| powerCapacity             | POST   | /appium/device/power_capacity                | Set battery percent on Android emulator (mjsonW... | {"required":["percent"]}                           |
| powerAC                   | POST   | /appium/device/power_ac                      | Set state of power charger on Android emulator(... | {"required":["state"]}                             |
| networkSpeed              | POST   | /appium/device/network_speed                 | Set Android emulator network speed (mjsonWire).    | {"required":["netspeed"]}                          |
| touchId                   | POST   | /simulator/touch_id                          | Simulate iOS touchID (mjsonWire)                   | {"required":["match"]}                             |
| postFrameParent           | POST   | /frame/parent                                | post /wd/hub/session/:sessionid/frame/parent       |                                                    |
| getElement                | GET    | /element/:elementid                          | get /wd/hub/session/:sessionid/element/:elementid  |                                                    |
| findElementFromElement    | POST   | /element/:elementid/element                  | post /wd/hub/session/:sessionid/element/:elemen... | {"required":["using","value"]}                     |
| findElementsFromElement   | POST   | /element/:elementid/elements                 | post /wd/hub/session/:sessionid/element/:elemen... | {"required":["using","value"]}                     |
| click                     | POST   | /element/:elementid/click                    | post /wd/hub/session/:sessionid/element/:elemen... |                                                    |
| submit                    | POST   | /element/:elementid/submit                   | post /wd/hub/session/:sessionid/element/:elemen... |                                                    |
| getText                   | GET    | /element/:elementid/text                     | get /wd/hub/session/:sessionid/element/:element... |                                                    |
| setValue                  | POST   | /element/:elementid/value                    | post /wd/hub/session/:sessionid/element/:elemen... | {"optional":["value","text"]}                      |
| getName                   | GET    | /element/:elementid/name                     | get /wd/hub/session/:sessionid/element/:element... |                                                    |
| clear                     | POST   | /element/:elementid/clear                    | post /wd/hub/session/:sessionid/element/:elemen... |                                                    |
| elementSelected           | GET    | /element/:elementid/selected                 | get /wd/hub/session/:sessionid/element/:element... |                                                    |
| elementEnabled            | GET    | /element/:elementid/enabled                  | get /wd/hub/session/:sessionid/element/:element... |                                                    |
| getAttribute              | GET    | /element/:elementid/attribute/:name          | get /wd/hub/session/:sessionid/element/:element... |                                                    |
| equalsElement             | GET    | /element/:elementid/equals/:otherid          | get /wd/hub/session/:sessionid/element/:element... |                                                    |
| elementDisplayed          | GET    | /element/:elementid/displayed                | get /wd/hub/session/:sessionid/element/:element... |                                                    |
| getLocation               | GET    | /element/:elementid/location                 | get /wd/hub/session/:sessionid/element/:element... |                                                    |
| getLocationInView         | GET    | /element/:elementid/location_in_view         | get /wd/hub/session/:sessionid/element/:element... |                                                    |
| getSize                   | GET    | /element/:elementid/size                     | get /wd/hub/session/:sessionid/element/:element... |                                                    |
| getCssProperty            | GET    | /element/:elementid/css/:propertyname        | get /wd/hub/session/:sessionid/element/:element... |                                                    |
| getRotation               | GET    | /rotation                                    | get /wd/hub/session/:sessionid/rotation            |                                                    |
| setRotation               | POST   | /rotation                                    | post /wd/hub/session/:sessionid/rotation           | {"required":["x","y","z"]}                         |
| getPageIndex              | GET    | /element/:elementid/pageindex                | get /wd/hub/session/:sessionid/element/:element... |                                                    |
| receiveAsyncResponse      | POST   | /receive_async_response                      | post /wd/hub/session/:sessionid/receive_async_r... | {"required":["status","value"]}                    |
| getDeviceTime             | GET    | /appium/device/system_time                   | get /wd/hub/session/:sessionid/appium/device/sy... |                                                    |
| unlock                    | POST   | /appium/device/unlock                        | post /wd/hub/session/:sessionid/appium/device/u... |                                                    |
| isLocked                  | POST   | /appium/device/is_locked                     | post /wd/hub/session/:sessionid/appium/device/i... |                                                    |
| startRecordingScreen      | POST   | /appium/start_recording_screen               | post /wd/hub/session/:sessionid/appium/start_re... | {"required":["filePath","videoSize","timeLimit"... |
| stopRecordingScreen       | POST   | /appium/stop_recording_screen                | post /wd/hub/session/:sessionid/appium/stop_rec... |                                                    |
| getPerformanceDataTypes   | POST   | /appium/performancedata/types                | post /wd/hub/session/:sessionid/appium/performa... |                                                    |
| getPerformanceData        | POST   | /appium/performancedata                      | post /wd/hub/session/:sessionid/appium/getperfo... | {"required":["packageName","dataType"],"optiona... |
| longPressKeyCode          | POST   | /appium/device/long_press_keycode            | post /wd/hub/session/:sessionid/appium/device/l... | {"required":["keycode"],"optional":["metastate"]}  |
| isKeyboardShown           | GET    | /appium/device/is_keyboard_shown             | get /wd/hub/session/:sessionid/appium/device/is... |                                                    |
| getSystemBars             | GET    | /appium/device/system_bars                   | get /wd/hub/session/:sessionid/appium/device/sy... |                                                    |
| getDisplayDensity         | GET    | /appium/device/display_density               | get /wd/hub/session/:sessionid/appium/device/di... |                                                    |
| simulatorTouchId          | POST   | /appium/simulator/touch_id                   | post /wd/hub/session/:sessionid/appium/simulato... | {"required":["match"]}                             |
| toggleEnrollTouchId       | POST   | /appium/simulator/toggle_touch_id_enrollment | post /wd/hub/session/:sessionid/appium/simulato... | {"optional":["enabled"]}                           |
| setValueImmediate         | POST   | /appium/element/:elementid/value             | post /wd/hub/session/:sessionid/appium/element/... | {"required":["value"]}                             |
| replaceValue              | POST   | /appium/element/:elementid/replace_value     | post /wd/hub/session/:sessionid/appium/element/... | {"required":["value"]}                             |
| updateSettings            | POST   | /appium/settings                             | post /wd/hub/session/:sessionid/appium/settings    | {"required":["settings"]}                          |
| getSettings               | GET    | /appium/settings                             | get /wd/hub/session/:sessionid/appium/settings     |                                                    |
| appReceiveAsyncResponse   | POST   | /appium/receive_async_response               | post /wd/hub/session/:sessionid/appium/receive_... | {"required":["response"]}                          |
| getAlertTextEx            | GET    | /alert/text                                  | get /wd/hub/session/:sessionid/alert/text          |                                                    |
| setAlertTextEx            | POST   | /alert/text                                  | post /wd/hub/session/:sessionid/alert/text         | {"required":["text"]}                              |
| postAcceptAlertEx         | POST   | /alert/accept                                | post /wd/hub/session/:sessionid/alert/accept       |                                                    |
| postDismissAlertEx        | POST   | /alert/dismiss                               | post /wd/hub/session/:sessionid/alert/dismiss      |                                                    |
| getElementRect            | GET    | /element/:elementid/rect                     | get /wd/hub/session/:sessionid/element/:element... |                                                    |


[comment]: # (core-function-comment)
Here you can find list of commands and there explanation: [appium driver commands](https://www.google.com).