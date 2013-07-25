<?php

require_once __WPCART_PATH__.'core/lib/Application/Application.php';

class WPCartRouter
{	
	private $config;
	private $route;
	private $action;
	private $params;

	function __construct() {
		$this->config = include('application/config/application.config.php');
	}

	public function route()
	{
		
		$this->route = isset($_GET['wpcart_route']) ? $_GET['wpcart_route'] : 'index';
		$this->action = isset($_GET['wpcart_action']) ? $_GET['wpcart_action'] : 'index';
		$this->params = isset($_POST) ? $_POST : array();
		$this->runApp();

		die();
	}

	public function cart()
	{
		$this->route = 'cart';
		$this->action = isset($_GET['wpcart_action']) ? $_GET['wpcart_action'] : 'index';
		$this->params = isset($_POST) ? $_POST : array();
		$this->runApp();

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

	public function runApp()
	{
		chdir(__WPCART_PATH__);

		$application = new Application;

		$application->setConfig($this->config);
		$application->setRoute($this->route);
		$application->setAction($this->action);
		$application->setParams($this->params);
		$application->run();
	}
}