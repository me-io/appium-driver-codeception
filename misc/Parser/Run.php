<?php

include __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\Console\Application;

// appium-base-driver routes : https://github.com/appium/appium-base-driver/blob/master/lib/mjsonwp/routes.js
// convert js var to json : http://phrogz.net/JS/NeatJSON/

$application = new Application();
$application->add(new \Parser\JsonParserCommand());
$application->run();
