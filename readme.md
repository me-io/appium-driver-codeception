# Codeception appium driver

## Install

Include codeception appium driver in the composer.json file:

```
"tajawal/codeception-appium": "dev-master"
```

Run composer update:

```
composer update
```

This will install codeception appium driver and install all dependencies. 
Now enable it in your suite yml file:

```
modules:
  enabled:
    ...
    - \Appium\AppiumDriver
```

Now run build codeception command and you are good to go:

```
codecept build
```

## Configure

Add next configuration in the yml file to configure your driver:

```
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

## Documentation

Methods in PHPUnit_Extensions_AppiumTestCase:

* byIOSUIAutomation
* byAndroidUIAutomator
* byAccessibilityId
* keyEvent
* pullFile
* pushFile
* backgroundApp
* isAppInstalled
* installApp
* removeApp
* launchApp
* closeApp
* endTestCoverage
* lock
* shake
* getDeviceTime
* hideKeyboard
* initiateTouchAction
* initiateMultiAction
* scroll
* dragAndDrop
* swipe
* tap
* pinch
* zoom
* startActivity
* getSettings
* setSettings
* Methods in PHPUnit_Extensions_AppiumTestCase_Element
* byIOSUIAutomation
* byAndroidUIAutomator
* byAccessibilityId
* setImmediateValue
* Methods for Touch Actions and Multi Gesture Touch Actions

Appium 1.0 allows for much more complex ways of interacting with your app through Touch Actions and Multi Gesture Touch Actions. The PHPUnit_Extensions_AppiumTestCase_TouchAction class allows for the following events:

* tap
* press
* longPress
* moveTo
* wait
* release

All of these except tap and release can be chained together to create arbitrarily complex actions. Instances of the PHPUnit_Extensions_AppiumTestCase_TouchAction class are obtained through the Test Class's initiateTouchAction method, and dispatched through the perform method.

The Multi Gesture Touch Action API allows for adding an arbitrary number of Touch Actions to be run in parallel on the device. Individual actions created as above are added to the multi action object (an instance of PHPUnit_Extensions_AppiumTestCase_MultiAction obtained from the Test Class's initiateMultiAction method) through the add method, and the whole thing is dispatched using perform.

Here you can find list of commands and there explanation: [appium driver commands](https://www.google.com).
