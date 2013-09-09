<?php
session_start();

if(isset($_POST['wpcart_checkout']) && $_POST['wpcart_checkout'] == 'true'){

	wpcart_intercept_checkout();
}

function wpcart_intercept_checkout()
{
	chdir(__WPCART_PATH__);

	require_once 'core/lib/Wordpress/Router/Router.php';

	$router = new WPCartRouter;

	$router->checkout();
}
