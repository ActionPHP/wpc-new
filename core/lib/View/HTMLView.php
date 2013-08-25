<?php

require_once 'AbstractView.php';

class HTMLView extends AbstractView
{
	private $data;

	function __construct($data=array()) {

		$this->data = $data;
	}

	public function render()
	{
		return 'This is the checkout!';
	}

	public function setTemplate($template)
	{
		

	}

	public function getTemplate()
	{
		# code...
	}
}