<h1 align="center">
  Appium Driver for Codeception 
</h1>
<p align="center" style="font-size: 1.2rem;">Appium driver for codeception for writing mobile tests.</p>

<hr />

[![Build Status][build-badge]][build]
[![downloads][downloads-badge]][downloads]
[![MIT License][license-badge]][license]
[![Donate][donate-badge]][donate]

[![All Contributors](https://img.shields.io/badge/all_contributors-2-orange.svg?style=flat-square)](#contributors)
[![PRs Welcome][prs-badge]][prs]
[![Code of Conduct][coc-badge]][coc]
[![Watch on GitHub][github-watch-badge]][github-watch]
[![Star on GitHub][github-star-badge]][github-star]
[![Tweet][twitter-badge]][twitter]

## Requirement

1. PHP >= 7.0
2. [Appium](http://appium.io/)
3. [Inspect App with Appium Desktop](https://medium.com/@eliasnogueira/inspect-an-app-with-the-new-appium-desktop-8ce4dc9aa95c)
4. Devices:
   * **Android**
      * [Setup Android SDK on Mac](https://gist.github.com/agrcrobles/165ac477a9ee51198f4a870c723cd441)
   * **iOS**
      * Install Xcode from the following [link](https://developer.apple.com/xcode/) or run the following command
        inside your terminal:
        ```bash
        xcode-select --install
        ```
      * Install the Carthage dependency manager:
        ```bash
        brew install carthage
        ```

## Table of Contents

* [Install](#install)
* [Tests](#tests)
  * [Writing tests for Android](#writing-tests-for-android)
  * [Writing tests for iOS](#writing-tests-for-ios)
  * [Generating Actor classes](#generating-actor-classes)
  * [Your First Android Test](#your-first-android-test)
  * [Your First iOS Test](#your-first-ios-test)
  * [Running tests](#running-tests)

## Install

Just add `me-io/appium-driver-codeception` to your project's composer.json file:

```json
{
    "require": {
        "me-io/appium-driver-codeception": "~1"
    }
}
```

and then run `composer install`. This will install codeception appium driver and all it's dependencies. Or run the following command

```bash
composer require me-io/appium-driver-codeception
```

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
    # Enable appium driver
    - \Appium\AppiumDriver 
    -  Asserts
  config:
    # Configuration for appium driver
    \Appium\AppiumDriver:
      host: 0.0.0.0
      port: 4723
      dummyRemote: false
      resetAfterSuite: true
      resetAfterCest: false
      resetAfterTest: false
      resetAfterStep: false
      capabilities:
        platformName: 'Android'
        deviceName: 'Android device'
        automationName: 'Appium'
        appPackage: io.selendroid.testapp
        fullReset: false
        noReset: false
        newCommandTimeout: 7200
        nativeInstrumentsLib: true
        connection_timeout: 500
        request_timeout: 500
        autoAcceptAlerts: true
        appActivity: io.selendroid.testapp.HomeScreenActivity
        skipUnlock: true
```

> **Note**: `deviceName` should be set as `Android device` only for real device. For Android Emulator use the name of the virtual device.


### Writing tests for iOS

Now, lets create a new configuration file `ios.suite.yml` inside tests directory and put the following contents inside of it.

```yml
class_name: IosGuy
modules:
  enabled:
    # Enable appium driver
    - \Appium\AppiumDriver
    -  Asserts
  config:
    # Configuration for appium driver
    \Appium\AppiumDriver:
      host: 0.0.0.0
      port: 4723
      dummyRemote: false
      resetAfterSuite: true
      resetAfterCest: false
      resetAfterTest: false
      resetAfterStep: false
      capabilities:
        # PATH OF YOUR APP (something like  /Users/username/Documents/ios.app)
        app: ''
        # xcideOrgId is Apple developer team identifier string.
        xcodeOrgId: ''
        # xcodeSigningId is a string representing a signing certificate. iPhone Developer by default.
        xcodeSigningId: 'iPhone Developer'
        platformName: 'iOS'
        platformVersion: '11.2'
        deviceName: 'iPhone8'
        # Your device udid
        udid: ''
        useNewWDA: false
        newCommandTimeout: 7200
        automationName: 'XCUITest'
        autoAcceptAlerts: true
        fullReset: false
        noReset: true
        nativeInstrumentsLib: true
        connection_timeout: 500
        request_timeout: 500
        skipUnlock: true
        clearSystemFiles: true
        showIOSLog: true
```

### Generating Actor classes

Now we need to generate actor class for the  `AndroidGuy`/`IosGuy` that we defined in `android.suite.yml`/`ios.suite.yml`. To generate the actor class for `AndroidGuy`/`IosGuy` run the following command inside your terminal:

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

### Your First iOS Test

To create your first iOS test create a new directory `ios` inside `tests` folder. After creating the `ios` directory create a new file `FirstIosCest.php` and put the following contents inside of it:

```php
class FirstIosCest
{
    public function lockPhone(Ios $I)
    {
        $I->implicitWait([
            'ms' => 10000,
        ]);
        $I->assertEquals('Hello, World!', 'Hello, World!');
        $I->amGoingTo("lock phone");
        $I->lock([null]);
    }
}
```

### Running tests

Run the appium server by running the following command:

```bash
appium
```
> **NOTE:** If you want to change IP/Port run the appium command like this:
```
appium -a <IP Address> -p <Port>
```

After running the appium server now you need to start android emulator and install the application that you want to test. If you don't know how to start the emulator you can follow the following guide [Setup Genymotion Android Emulators on Mac OS
](https://shankargarg.wordpress.com/2016/02/25/setup-genymotion-android-emulators-on-mac-os/)

Now run the following command inside your terminal to run the tests:

```bash
# For Android
codecept run android FirstAndroidCest.php --steps

# For iOS
codecept run ios FirstIosCest.php --steps
```

> **Note**: While following the steps that are mentioned here if you get `codecept command not found` error try to run `codecept` command like this `./vendor/bin/codecept`.

## Contributors

A huge thanks to all of our contributors:

<!-- ALL-CONTRIBUTORS-LIST:START - Do not remove or modify this section -->
<!-- prettier-ignore -->
| [<img src="https://avatars0.githubusercontent.com/u/45731?v=3" width="100px;"/><br /><sub><b>Mohamed Meabed</b></sub>](https://github.com/Meabed)<br />[💻](https://github.com/me-io/appium-driver-codeception/commits?author=Meabed "Code") [📢](#talk-Meabed "Talks") | [<img src="https://avatars2.githubusercontent.com/u/16267321?v=3" width="100px;"/><br /><sub><b>Zeeshan Ahmad</b></sub>](https://github.com/ziishaned)<br />[💻](https://github.com/me-io/appium-driver-codeception/commits?author=ziishaned "Code") [🐛](https://github.com/me-io/appium-driver-codeception/issues?q=author%3Aziishaned "Bug reports") [⚠️](https://github.com/me-io/appium-driver-codeception/commits?author=ziishaned "Tests") [📖](https://github.com/me-io/appium-driver-codeception/commits?author=ziishaned "Documentation") |
| :---: | :---: |
<!-- ALL-CONTRIBUTORS-LIST:END -->


## License

The code is available under the [MIT license](LICENSE.md).

[build-badge]: https://img.shields.io/travis/me-io/appium-driver-codeception.svg?style=flat-square
[build]: https://travis-ci.org/me-io/appium-driver-codeception
[downloads-badge]: https://img.shields.io/packagist/dm/me-io/appium-driver-codeception.svg?style=flat-square
[downloads]: https://packagist.org/packages/me-io/appium-driver-codeception/stats
[license-badge]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[license]: https://github.com/me-io/appium-driver-codeception/blob/master/LICENSE.md
[prs-badge]: https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square
[prs]: http://makeapullrequest.com
[coc-badge]: https://img.shields.io/badge/code%20of-conduct-ff69b4.svg?style=flat-square
[coc]: https://github.com/me-io/appium-driver-codeception/blob/master/CODE_OF_CONDUCT.md
[github-watch-badge]: https://img.shields.io/github/watchers/me-io/appium-driver-codeception.svg?style=social
[github-watch]: https://github.com/me-io/appium-driver-codeception/watchers
[github-star-badge]: https://img.shields.io/github/stars/me-io/appium-driver-codeception.svg?style=social
[github-star]: https://github.com/me-io/appium-driver-codeception/stargazers
[twitter]: https://twitter.com/intent/tweet?text=Check%20out%20appium-driver-codeception!%20https://github.com/me-io/appium-driver-codeception%20%F0%9F%91%8D
[twitter-badge]: https://img.shields.io/twitter/url/https/github.com/me-io/appium-driver-codeception.svg?style=social
[donate-badge]: https://img.shields.io/badge/paypal-donate-179BD7.svg?style=flat-squares 
[donate]: https://www.paypal.me/meabed
