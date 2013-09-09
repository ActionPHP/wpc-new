<?php

require_once 'AbstractView.php';

class HTMLView extends AbstractView
{
	private $data;

	function __construct($data=array()){

		$this->data = $data;
	}

	public function render()
	{
		$template = $this->getTemplate();

		$_data = $this->data;
		
		if($template && file_exists($template)){
			
			extract($_data);
			include $template;

		} else {

			throw new Exception("View template not found!");
			
		}
		
	//	return 'This is the checkout!';
	}

	public function setTemplate($template)
	{
		$this->template = $template;
	}

	public function getTemplate()
	{
		return $this->template;
	}

	public function getTemplatePath()
	{

	}
}