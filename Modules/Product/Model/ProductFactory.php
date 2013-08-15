<?php

require_once __WPCART_PATH__ . 'core/lib/Table/WPTableGateway.php';
require_once 'Product.php';
require_once 'ProductTable.php';

class ProductFactory
{
	function __construct() {
		
	}

	public function product()
	{
		$productTableGateway = new WPTableGateway('WPCartProduct');
		$product_table = new ProductTable($productTableGateway);

		$product = new Product($product_table);

		return $product;
	}
}