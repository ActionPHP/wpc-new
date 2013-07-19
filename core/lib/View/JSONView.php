<?php
require_once 'AbstractView.php';

class JSONView extends AbstractView
{
	public function __construct($data=array())
	{
		$this->setData($data);
		$this->validateData();

	}
	
	public function render()
	{	
		$data = $this->getData();

		$json = json_encode($data);

		return $json;
	}

	public function setData($data)
	{
		$this->data = $data;
	}

	public function getData()
	{
		return $this->data;
	}

	public function setTemplate($template)
	{
		# code...
	}

	public function getTemplate()
	{
		# code...
	}

	public function output()
	{
		# code...
	}

	public function validateData()
	{
		$data = $this->getData();

		if(!is_array($data)){

			throw new Exception("Invalid data provided for JSONView!");
			
		}

		return true;
	}
}