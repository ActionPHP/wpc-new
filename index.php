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
$admin_dir = getcwd();
define('__WPCART_PATH__', plugin_dir_path(__FILE__));

if(is_admin()){

	chdir(__WPCART_PATH__);
	require_once 'core/lib/Wordpress/WPCartWordpress.php';
	require 'core/lib/Wordpress/Router/Router.php';

	$wpcart_router = new WPCartRouter;
	$wpcart = new WPCartWordpress;

	$wpcart->wp_ajax('wpcart_route', array($wpcart_router, 'route'));
	$wpcart->wp_ajax('wpcart_route', array($wpcart_router, '__404'), true);

	include 'init.php';
	chdir($admin_dir);
}