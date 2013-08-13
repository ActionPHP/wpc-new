<?php

/**
 * Let's enqueue some scripts
 */

add_action('admin_enqueue_scripts', 'wpcart_admin_scripts');

function wpcart_admin_scripts($hook){

		$wpcart_page = preg_match('/wpcart-main-menu/', $hook);

		if($wpcart_page){

			wp_enqueue_script( 'json2' );
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'wpcart__toggle_js',  plugins_url('public/js/_toggle.js', __FILE__), array('backbone', 'jquery') );
			wp_enqueue_script( 'wpcart_app', plugins_url('public/js/wpcart-app.js', __FILE__), array('backbone', 'jquery-ui-sortable', 'wpcart__toggle_js') );
			wp_enqueue_script( 'wpcart_bootstrap_js', "//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js", array( 'jquery') );
			//wp_enqueue_script( 'wpcart_script_js', plugins_url('js/script.js', __FILE__) );
			
			//wp_enqueue_script( 'wpcart_ckeditor_basepath', plugins_url('public/js/php/ckeditor_basepath.php', __FILE__));
			//wp_enqueue_script( 'wpcart_ckeditor', plugins_url('public/js/ckeditor/ckeditor.js', __FILE__), array('wpcart_ckeditor_basepath'));

			wp_register_style( 'wpcart_bootstrap_css', "//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" );
        	wp_enqueue_style( 'wpcart_bootstrap_css' );
			
			wp_register_style( 'wpcart_style', plugins_url('public/css/style.css', __FILE__) );
        	wp_enqueue_style( 'wpcart_style' );

        	wp_enqueue_script('wp_cart_tagsinput', plugins_url('wpcart/public/js/jquery.tagsinput.min.js'), array( 'jquery') );
			wp_enqueue_style('wp_cart_tagsinput_css', plugins_url('wpcart/public/css/jquery.tagsinput.css') );
		}
	
}


add_action('admin_menu', 'wpcart_main_menu');

function wpcart_main_menu(){
	
	add_menu_page('WPCart', 'Wordpress Shopping Cart', 'manage_options',
			'wpcart-main-menu', 'create_main_menu');
	add_submenu_page('wpcart-main-menu', 'Manage Products', 'Your Products',
		'manage_options', 'wpcart-main-menu-products', 'wpcart_main_menu_products');
	
}

function create_main_menu(){

			include 'application/wp-menu/main-menu.php';
}

function wpcart_main_menu_products(){

			include 'application/wp-menu/products.php';
}