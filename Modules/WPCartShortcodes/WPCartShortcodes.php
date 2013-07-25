<?php

class WPCartShortcodes
{	
	function __construct() {
		$this->create();

	}

	public function create()
	{
		add_shortcode('wpcart_listing', array($this, 'listing'));
	}

	public function shortcode($name, $method )
	{
		# code...
	}

	public function addButton()
	{
		# code...
	}

	public function buyButton()
	{
		# code...
	}

	public function listing($args=array())
	{
		return '<div class="wpcart-listing" ></div>';
	}
	

}