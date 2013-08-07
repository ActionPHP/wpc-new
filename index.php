<?php
/*
Plugin Name: Shopping Cart
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

//Let's determine if this
$wpcart_shopping_action = (isset($_REQUEST['action']) && $_REQUEST['action'] == 'wpcart_shopping_route' ) ?  true :  false;

define('__WPCART_SHOPPING__', $wpcart_shopping_action);

if(is_admin() || __WPCART_SHOPPING__){

	chdir(__WPCART_PATH__);
	require_once 'core/lib/Wordpress/WPCartWordpress.php';
	require_once 'core/lib/Wordpress/Router/Router.php';

	$wpcart_router = new WPCartRouter;
	$wpcart = new WPCartWordpress;

	$wpcart->wp_ajax('wpcart_route', array($wpcart_router, 'route'));
	$wpcart->wp_ajax('wpcart_route', array($wpcart_router, '__404'), true);
	$wpcart->wp_ajax('wpcart_shopping_route', array($wpcart_router, 'cart'));//This allows
	// Wordpress admin to shop as well.
	$wpcart->wp_ajax('wpcart_shopping_route', array($wpcart_router, 'cart'), true);//
	// Nopriv route for shoppers


	$wpcart->wp_ajax('wpcart_ipn', array($wpcart_router, 'ipn'));
	$wpcart->wp_ajax('wpcart_ipn', array($wpcart_router, 'ipn'), true);

	include 'init.php';
	chdir($admin_dir);
}

if(!is_admin()){

	include 'application/config/front-end-init.php';
}

//Let's create our database
register_activation_hook(__FILE__, 'wpcart_product_table');
function wpcart_product_table()
	{
		global $wpdb;
		$table_name = $wpdb->prefix . 'WPCartProduct';

		$sql = "

		CREATE TABLE IF NOT EXISTS $table_name
		(
			id INT NOT NULL AUTO_INCREMENT
			,PRIMARY KEY (id)
			,family_id INT NOT NULL 
			,category_id INT NOT NULL 
			,sku VARCHAR(250) NOT NULL 
			,name VARCHAR(255) NOT NULL 
			,brief_description VARCHAR(250) NOT NULL 
			,description TEXT NOT NULL 
			,price DECIMAL(11, 2) NOT NULL
			,weight DECIMAL(11, 2) NOT NULL 
			,tags TEXT NOT NULL,
			Status VARCHAR(10) DEFAULT 'fresh' NOT NULL
		)

		";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	
		dbDelta($sql);

		$table_name = $wpdb->prefix . 'WPCartProperty';

		$sql = "CREATE TABLE IF NOT EXISTS $table_name
		(
			id INT NOT NULL AUTO_INCREMENT
			,PRIMARY KEY (id)
			,family_id INT NOT NULL 
			,name VARCHAR(250) NOT NULL
			,Status VARCHAR(10) DEFAULT 'fresh' NOT NULL
		)";

		dbDelta($sql);

		$table_name = $wpdb->prefix . 'WPCartPropertyValue';

		$sql = "CREATE TABLE IF NOT EXISTS $table_name
		(
			id INT NOT NULL AUTO_INCREMENT
			,PRIMARY KEY (id)
			,property_id INT NOT NULL 
			,name TEXT NOT NULL
			,Status VARCHAR(10) DEFAULT 'fresh' NOT NULL
		)";
	
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	
		dbDelta($sql);

		$table_name = $wpdb->prefix . 'WPCartCategory';

		$sql = "CREATE TABLE IF NOT EXISTS $table_name
		(
			id INT NOT NULL AUTO_INCREMENT
			,PRIMARY KEY (id)
			,name VARCHAR(250) NOT NULL 
			,description TEXT NOT NULL 
			,image VARCHAR(1024) NOT NULL 
			,tag_line VARCHAR(250) NOT NULL
			,Status VARCHAR(10) DEFAULT 'fresh' NOT NULL
		)";

		dbDelta($sql);

		$table_name = $wpdb->prefix . 'WPCartFamily';

		$sql = "CREATE TABLE IF NOT EXISTS $table_name
		(
			id INT NOT NULL AUTO_INCREMENT
			,PRIMARY KEY (id)
			,name VARCHAR(250) NOT NULL
			,Status VARCHAR(10) DEFAULT 'fresh' NOT NULL
		)";

		dbDelta($sql);
		
		$table_name = $wpdb->prefix . 'WPCartProductPropertyValue';
		
		$sql = "CREATE TABLE IF NOT EXISTS $table_name
		(
			id INT NOT NULL AUTO_INCREMENT
			,PRIMARY KEY (id)
			,property_value_id INT NOT NULL 
			,product_id INT NOT NULL 
			,affects_price BIT NOT NULL 
			,price_difference DECIMAL(11,2) NOT NULL
			,Status VARCHAR(10) DEFAULT 'fresh' NOT NULL
		)";

	
		dbDelta($sql);

		$table_name = $wpdb->prefix . 'WPCartVariant';
		
		$sql = "CREATE TABLE IF NOT EXISTS $table_name
		(
			id INT NOT NULL AUTO_INCREMENT
			,PRIMARY KEY (id)
			,product_id INT NOT NULL 
			,Status VARCHAR(10) DEFAULT 'fresh' NOT NULL
		)";

		dbDelta($sql);

		$table_name = $wpdb->prefix . 'WPCartVariantOptions';

		$sql = "CREATE TABLE IF NOT EXISTS $table_name
		(
			id INT NOT NULL AUTO_INCREMENT
			,PRIMARY KEY (id)
			,variant_id INT NOT NULL 
			,product_id INT NOT NULL 
			,option_id INT NOT NULL 
			,option_value_id INT NOT NULL 
			,Status VARCHAR(10) DEFAULT 'fresh' NOT NULL
		)";

		dbDelta($sql);

	}