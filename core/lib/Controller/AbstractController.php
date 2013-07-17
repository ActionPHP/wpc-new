<?php

abstract class AbstractController
{
	private $action;
	private $params;

	public function execute()
	{
		$actionMethod = $this->getActionMethod();


		if(!method_exists($this, $actionMethod)){

			$action = $this->getAction();
			throw new Exception("Action $action not found!");			
		}

		$this->$actionMethod();
	}
	
	public function setAction($action)
	{
		$this->action = $action;
	}

	public function getAction()
	{
		return $this->action;
	}

	public function setParams(Array $params)
	{
		$this->params = $params;
	}

	public function getActionMethod($suffix = '_Action')
	{
		$action = $this->getAction();

		//Let's to a check if the action is valid!
		$this->validate($action);
		
		$actionMethod = $action . $suffix;

		return $actionMethod;
	}
	public function getParams($key=null)
	{
		$params = $this->params;

		if(!$key){

			return $params;
		}

		return $params[$key];
	}

	
}