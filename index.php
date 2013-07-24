<?php
/*
Plugin Name: Wordpress Shopping Cart
Plugin URI: http://WPCart.net/shopping-cart
Description: Simple Wordpress Shopping Cart 
Version: 0.9
Author: Jean Paul
Author URI: http://ActionPHP.com
License: GPL2
*/
?><?php
chdir(dirname(__DIR__) . '/wpcart');

require_once 'core/lib/Application/Application.php';
$config = include('application/config/application.config.php');


$route = isset($_GET['wpcart_route']) ? $_GET['wpcart_route'] : 'index';
$action = isset($_GET['wpcart_action']) ? $_GET['wpcart_action'] : 'index';
$params = isset($_POST) ? $_POST : array();

$application = new Application;

$application->setConfig($config);
$application->setRoute($route);
$application->setAction($action);
$application->setParams($params);
$application->run();