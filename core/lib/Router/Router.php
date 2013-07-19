<?php
/**
 * Class Router
 * 
 * All the router needs to do is to execute the right controller action, with
 * the right parameters.
 */
class Router
{	
	private $controllerFolder;
	private $modules_path;
	private $route;

	public function execute()
	{
		//Let's get the controller path
		$controllerPath = $this->getRouteControllerPath();
			
			include_once $controllerPath;

		//Let's instantiate controller

		$controllerName = $this->getRouteController();
		$controller = new $controllerName;

		//Let's get the params
		
		$params = $this->getRouteParams();
		
		//Let's execute the action

		$action = $this->getRouteAction();

		$controller->setAction($action);
		$controller->setParams($params);
		return $controller->invoke();
	}

	public function parseParams()
	{
		# code...
	}
	public function getRouteAction()
	{
		$route = $this->getRoute();
		$action = $route->Action;
		return $action;
	}

	public function getRouteModule()
	{
		$route = $this->getRoute();
		$module = $route->Module;
		return $module;
	}

	public function getRouteController()
	{
		$route = $this->getRoute();
		$controller = $route->Controller;
		return $controller;
	}

	public function getRouteControllerPath()
	{
		$modules_path = $this->getModulesPath();
		$module = $this->getRouteModule();
		$controller = $this->getRouteController();
		$controllerFolder = $this->getControllerFolder();

		$path = $modules_path . '/' . $module . '/';

		if($controllerFolder){

			$path .= $controllerFolder . '/';
		}

		$path .= $controller . '.php';

		
		if(!file_exists($path)){

			throw new Exception("Controller $controller not found!");

			}

		return $path;

	}

	public function setControllerFolder($controllerFolder = 'Controller')
	{
		$this->controllerFolder = $controllerFolder;
	}

	public function getControllerFolder()
	{
		return $this->controllerFolder;
	}

	public function setModulesPath($modules_path)
	{
		$this->modules_path = $modules_path;	
	}

	public function getModulesPath()
	{
		return $this->modules_path;
	}

	public function getRouteParams()
	{
		$route = $this->getRoute();
		$params = $route->Params;
		return $params;
	}


	public function setRoute(Route $route)
	{
		$this->route = $route;
	}
	
	public function getRoute()
	{
		return $this->route;
	}

}
