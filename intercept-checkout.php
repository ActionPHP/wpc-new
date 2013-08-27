<?php
session_start();

chdir(__WPCART_PATH__);

	require_once 'core/lib/Wordpress/Router/Router.php';

	$router = new WPCartRouter;

	$router->checkout();