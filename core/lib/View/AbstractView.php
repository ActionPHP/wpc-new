<?php

abstract class AbstractView
{
	abstract function render();

	public function setTemplate($template)
	{
		$this->template = $template;
	}
	
	public function getTemplate()
	{
		return $this->template;
	}
}