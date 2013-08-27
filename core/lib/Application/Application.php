<?php

require_once 'core/lib/Controller/AbstractController.php';
require_once 'core/lib/Router/Router.php';
require_once 'core/lib/Router/RouteMatch.php';
require_once 'core/lib/Event/Event.php';

class Application
{
	private $router;

	public function __construct()
	{
		$this->router = new Router;
		$this->routeMatch = new RouteMatch;
		$this->reg = Registry::getInstance();
	}

	public function run()
	{
		
		$config = $this->getConfig();
		
		//Let's match the route
		$this->routeMatch->setRouteConfig($config['routes']);

		$route = $this->getRoute();
		$action = $this->getAction();

		//If action is blank, it's going to be set to index
		$action = ($action) ? $action : 'index';

		$this->routeMatch->setRoute($route);
		$this->routeMatch->setAction($action);
		$this->routeMatch->setParams($this->getParams());

		$matchedRoute = $this->routeMatch->match();

		$this->reg->matchedRoute = $matchedRoute;

		//Let's pass the matched route to the router
		$this->router->setRoute($matchedRoute);
		
		$this->router->setModulesPath($config['module_path']['0']);
		$this->router->setControllerFolder();
		$view = $this->router->execute();
		
		$this->output($view);
		
	}

	public function setParams($params)
	{
		$this->params = $params;
	}

	public function getParams()
	{
		return $this->params;
	}

	public function setConfig($config)
	{
		$this->config = $config;
	}

	public function getConfig()
	{
		return $this->config;
	}

	public function setRoute($route)
	{
		$this->route = $route;
	}

	public function getRoute()
	{
		return $this->route;
	}

	public function setAction($action)
	{
		$this->action = $action;
	}

	public function getAction()
	{
		return $this->action;
	}

	public function output($view)
	{
		if(is_a($view, 'AbstractView')){

			echo $view->render();
			die();
		}
	}

}