<?php

abstract class AbstractController
{
	private $action;
	private $params;

	public function invoke()
	{
		$this->validateAction();//Important! This ensures that we're executing a
		// valid, secure action.
		
		$actionMethod = $this->getActionMethod();

		return $this->$actionMethod();
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
		
		$action = str_replace(array(' ', '.', '-'), '_', $action);

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

	public function validateAction()
	{
		$actionMethod = $this->getActionMethod();
		
		if(!method_exists($this, $actionMethod)){

			$action = $this->getAction();
			throw new Exception("Action $action not found!");			
		}

		return true;
	}
}