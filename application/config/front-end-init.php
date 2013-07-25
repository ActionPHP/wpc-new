<?php
require_once __WPCART_PATH__ . 'Modules/WPCartShortcodes/WPCartShortcodes.php';
//We will have our shortcodes created

$shortcodes = new WPCartShortcodes;

add_action('wp_head', 'wpcart_js_setup');

function wpcart_js_setup()
{	

	include __WPCART_PATH__ . 'public/js/wpcart_setup.php';
}

add_action('wp_enqueue_scripts', 'wpcart_front_end_scripts');

function wpcart_front_end_scripts()
{
	//wp_enqueue_script('wp_cart_front_end_setup', plugins_url('wpcart/public/js/wpcart_setup.php') );

	wp_enqueue_script('wp_cart_front_end', plugins_url('wpcart/public/js/wpcart-script.js'), array( 'backbone', 'jquery-ui-sortable') );
}