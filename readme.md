<p align="center">
  <h3 align="center">Codeception Appium Driver</h3>
  <p align="center">This is the codeception appium driver for writing Appium Tests.</p>
  <p align="center">
            <a href="LICENSE.md">
      <img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License">
    </a>
  </p>
</p>

## Requirement

1. PHP >= 7
2. [Appium](http://appium.io/)
3. [Setup Android SDK on Mac](https://gist.github.com/agrcrobles/165ac477a9ee51198f4a870c723cd441)
4. [Inspect App with Appium Desktop](https://medium.com/@eliasnogueira/inspect-an-app-with-the-new-appium-desktop-8ce4dc9aa95c)

## Table of Contents

* [Install](#install)
* [Tests](#tests)
  * [Writing tests for Android](#writing-tests-for-android)
  * [Generating Actor classes](#generating-actor-classes)
  * [Your First Android Test](#your-first-android-test)
  * [Running tests](#running-tests)

## Install

Just add `tajawal/codeception-appium` to your project's composer.json file:

```json
{
    "require": {
        "tajawal/codeception-appium": "dev-master"
    }
}
```

and then run `composer install`. This will install codeception appium driver and all it's dependencies.

## Tests

Now lets run the following command at the root directory of your project:

```bash
codecept bootstrap
```

This command will creates a configuration file for codeception and tests directory and default test suites.

### Writing tests for Android

Now, lets create a new configuration file `android.suite.yml` inside tests directory and put the following contents inside of it.

```yml
class_name: AndroidGuy
modules:
    enabled:
        - \Appium\AppiumDriver # Enable appium driver
        -  Asserts
    config:
        \Appium\AppiumDriver: # Configuration for appium driver
            host            : 0.0.0.0
            port            : 4723
            dummyRemote     : false
            resetAfterSuite : true
            resetAfterCest  : false
            resetAfterTest  : false
            resetAfterStep  : false
            capabilities:
                platformName          : 'Android'
                deviceName            : 'Android device'
                automationName        : 'Appium'
                appPackage            : com.travel.almosafer
                fullReset             : false
                noReset               : false
                newCommandTimeout     : 7200
                nativeInstrumentsLib  : true
                connection_timeout    : 500
                request_timeout       : 500
                autoAcceptAlerts      : true
                appActivity           : com.tajawal.splash.SplashActivity
                skipUnlock            : true
```

### Generating Actor classes

Now we need to generate actor class for the  `AndroidGuy` that we defined in `android.suite.yml`. To generate the actor class for `AndroidGuy` run the following command inside your terminal:

```bash
codecept build
```

### Your First Android Test

To create your first android test create a new directory `android` inside `tests` folder. After creating the `android` folder create a new file `FirstAndroidCest.php` and put the following contents inside of it:

```php
class FirstAndroidCest
{
    public function changeLanguage(AndroidGuy $I)
    {
        $I->implicitWait([
            'ms' => 3500,
        ]);
        $text = $I->byId('id_of_button')->getText();
        $I->assertEquals('Hello, World!', $text);
    }
}
```

### Running tests

Run the following command inside your terminal to run the tests:

```bash
codecept run --steps
```

> **Note**: While following the steps that are mentioned here if you get `codecept command not found` error try to run `codecept` command like this `./vendor/bin/codecept`.

## License

The code is available under the [MIT license](LICENSE.md).