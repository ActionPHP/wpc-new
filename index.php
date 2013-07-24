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

require_once 'core/lib/Wordpress/WPCartWordpress.php';
require 'core/lib/Wordpress/Router/Router.php';

$wpcart_router = new WPCartRouter;
$wpcart = new WPCartWordpress;

$wpcart->wp_ajax('wpcart_route', array($wpcart_router, 'route'));

include 'init.php';

