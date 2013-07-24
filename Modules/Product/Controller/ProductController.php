<?php

require 'core/lib/View/JSONView.php';
require 'core/lib/Table/WPTableGateway.php';
require_once 'Modules/Product/Model/Product.php';
require_once 'Modules/Product/Model/ProductTable.php';
class ProductController extends AbstractController
{	
	public function __construct()
	{
		$table = $this->getProductTable();
		$product = new Product($table);
		$this->product = $product;


	}

	public function index_Action()
	{

		if(isset($_GET['id'])){

			$id = $_GET['id'];
			if(!ctype_digit($id)){

				die('Really?');
			}

		$product = $this->product->get($id);
		$product = (array)$product;
		return new JSONView($product);

		}

		

		$products = $this->product->get();
		
		return new JSONView($products);
	}

	public function save_Action()
	{

		$item = json_decode($this->requestBody());		
		$id = $item->id;

		if(!$id){

			$saved_item = $this->product->create($item);

		} else {

			$saved_item = $this->product->update($item);
		}

		$saved_item = (array) $saved_item;

		return new JSONView($saved_item);
	}

	public function delete_Action()
	{
		$item = json_decode($this->requestBody());		
		$id = $item->id;

		$this->product->delete($id);
	}

	public function getProductTable()
	{
		$tableGateway = new WPTableGateway('WPCartProduct');
		$productTable = new ProductTable($tableGateway);

		return $productTable;
	}
}