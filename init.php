<?php

/**
 * Let's enqueue some scripts
 */

add_action('admin_enqueue_scripts', 'wpcart_admin_scripts');

function wpcart_admin_scripts($hook){

		$wpcart_page = preg_match('/wpcart-main-menu/', $hook);

		if($wpcart_page){

			wp_enqueue_script( 'json2' );
			wp_enqueue_script( 'wpcart_app', plugins_url('public/js/wpcart-app.js', __FILE__), array('backbone', 'jquery-ui-sortable') );
			wp_enqueue_script( 'wpcart_bootstrap_js', "//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js", array( 'jquery') );
			//wp_enqueue_script( 'wpcart_script_js', plugins_url('js/script.js', __FILE__) );
			
			//wp_enqueue_script( 'wpcart_ckeditor_basepath', plugins_url('public/js/php/ckeditor_basepath.php', __FILE__));
			//wp_enqueue_script( 'wpcart_ckeditor', plugins_url('public/js/ckeditor/ckeditor.js', __FILE__), array('wpcart_ckeditor_basepath'));

			wp_register_style( 'wpcart_bootstrap_css', "//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" );
        	wp_enqueue_style( 'wpcart_bootstrap_css' );
			
			wp_register_style( 'wpcart_style', plugins_url('public/css/style.css', __FILE__) );
        	wp_enqueue_style( 'wpcart_style' );
		}
	
}


add_action('admin_menu', 'wpcart_main_menu');

function wpcart_main_menu(){
	
	add_menu_page('WPCart', 'Wordpress Shopping Cart', 'manage_options',
			'wpcart-main-menu', 'wpcart_main_menu_products');
	/*add_submenu_page('wpcart-main-menu', 'Manage Products', 'Your Products',
		'manage_options', 'wpcart-main-menu-products', 'wpcart_main_menu_products');*/
	
}

function create_main_menu(){

			include 'application/wp-menu/main-menu.php';
}

function wpcart_main_menu_products(){

			include 'application/wp-menu/products.php';
}

//Let's create our database
register_activation_hook(__FILE__, 'wpcart_product_table');
function wpcart_product_table()
	{
		global $wpdb;
		$table_name = $this->table->getTableName();

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
			,tags TEXT NOT NULL 
		)

		";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	
		dbDelta($sql);

	}