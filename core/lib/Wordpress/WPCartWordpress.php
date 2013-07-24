<?php

class WPCartWordpress
{
	public function wp_ajax($action, $function, $nopriv=false)
	{
		$slug = $this->ajax_slug($action, $nopriv);

		add_action($slug, $function);

	}

	public function ajax_slug($action, $nopriv)
	{	

		$this->validateString($action);

		$slug = 'wp_ajax';

		if($nopriv) $slug .= '_nopriv';

		$slug .= '_'.$action;

		return $slug;
	}

	public function validateString($string)
	{
		if(!preg_match('/^[A-Za-z0-9_]+$/', $string)){

			throw new Exception('Invalid string value provided!');
			
		}

		return true;
	}
}