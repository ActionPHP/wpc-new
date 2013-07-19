<?php
require_once 'Route.php';

class RouteMatch
{	
	private $action;
	private $params;
	private $route;

	public function __construct()
	{
	
	}		
	
	public function match()
	{
		$routeConfig = $this->getRouteConfig();

		$route = $this->getRoute();
		$action = $this->getAction();

		if(!array_key_exists($route, $routeConfig)){

			throw new Exception('No route has been matched!');
			
		}

		$route = $routeConfig[$route];
		

		$module = $route['Module'] ;
		$controller = $route['Controller'];
		$params = $this->getParams();

		$matchedRoute = new Route;

		$matchedRoute->Module = $module;
		$matchedRoute->Controller = $controller;
		$matchedRoute->Action = $action;
		$matchedRoute->Params = $params;

		return $matchedRoute;

	}

	public function setRouteConfig($routeConfig)
	{
		$this->routeConfig = $routeConfig;
	}
	
	public function getRouteConfig()
	{
			return $this->routeConfig;
	}

	public function setParams($params)
	{
		$this->params = $params;
	}	


	public function getParams()
	{
		return $this->params;
	}

	public function setAction($action)
	{
		$this->action = $action;
	}

	public function getAction()
	{
		return $this->action;
	}

	public function setRoute($route)
	{
		$this->route = $route;
	}	
	
	public function getRoute()
	{
		return $this->route;
	}
}