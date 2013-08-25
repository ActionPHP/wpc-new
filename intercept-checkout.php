<?php
session_start();

chdir(__WPCART_PATH__);

	require_once 'core/lib/Wordpress/Router/Router.php';

	$router = new WPCartRouter;

	$router->checkout();



//require __WPCART_PATH__ . '';
?>
<pre>
<?php
if(isset($_POST['wpcart_checkout'])){

	print_r($_POST);
	die();
}