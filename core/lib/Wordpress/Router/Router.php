<?php

require_once __WPCART_PATH__.'core/lib/Application/Application.php';

class WPCartRouter
{
	public function route()
	{
		chdir(__WPCART_PATH__);
		
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

		die();
	}

	public function __404()
	{
		$response = array(
			
				'message' => 'Wrong URL'
			);

		$response = json_encode($response);

		die($response);
	}
}