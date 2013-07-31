<?php

require_once __WPCART_PATH__ . 'core/lib/Table/WPTableGateway.php';
require_once 'CartTable.php';

class CartTableFactory
{

	function __construct() {

	}

	public function cartTable()
	{
		$cartGateway = new WPTableGateway('WPCartTable');
		$cartTable = new CartTable($cartGateway);
		return $cartTable;
	}
}