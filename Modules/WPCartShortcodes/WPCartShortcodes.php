<?php

class WPCartShortcodes
{	
	function __construct() {
		$this->create();

	}

	public function create()
	{
		add_shortcode('wpcart_add_to_cart', array($this, 'addButton'));
		add_shortcode('wpcart_buy_now', array($this, 'buyButton'));
		add_shortcode('wpcart_temp_cart', array($this, 'tempCart'));
	}

	public function addButton($args=array())
	{
		$id = $args['id'];

		return '<input class="wpcart-listing" type="button" value="Add to cart" id="wpcart-item-' . $id . '" />';
	}

	public function buyButton($args=array())
	{
		$id = $args['id'];

		return '<input class="wpcart-listing" type="button" value="Buy now!" id="wpcart-item-' . $id . '" />';
	}

	public function tempCart()
	{
		return '<div id="wpcart-cart" ></div>';
	}

	public function listing()
	{

	}
	

}