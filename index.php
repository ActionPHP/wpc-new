<?php
chdir(dirname(__DIR__) . '/wpcart');

require_once 'core/lib/Application/Application.php';
$config = include('application/config/application.config.php');

$application = new Application;

$application->setConfig($config);
$application->setRoute('product');
$application->setAction('index');
$application->setParams(array( 'test' => 'successful'));
$application->run();