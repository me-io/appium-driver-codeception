<?php
include __DIR__ . '/../../../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Appium\Tools\AppiumParser\JsonParserCommand;

$application = new Application();
$application->add(new JsonParserCommand());
$application->run();