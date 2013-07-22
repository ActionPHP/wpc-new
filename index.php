<?php
chdir(dirname(__DIR__) . '/wpcart');

require_once 'core/lib/Application/Application.php';
$config = include('application/config/application.config.php');


$route = isset($_GET['route']) ? $_GET['route'] : 'index';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$params = isset($_POST) ? $_POST : array();

$application = new Application;

$application->setConfig($config);
$application->setRoute($route);
$application->setAction($action);
$application->setParams($params);
$application->run();