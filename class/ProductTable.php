<?php
require_once '../interface/TableInterface.php';

class ProductTable implements TableInterface
{
	public function __construct($tableGateway)
	{
		$this->setTableGateway($tableGateway);
	}
	
	public function create($product)
	{
		$tableGateway = $this->getTableGateway();
		
		//Let's get the product id
		$product_id = $tableGateway->create($product->name);
		$product->id = $product_id;

		$this->update($product);


		return $product_id;
	}

	public function get($product_id = null)
	{
		
		$tableGateway = $this->getTableGateway();
		$product = $tableGateway->get($product_id);
		return $product;


	}

	public function update($product)
	{
		
		$tableGateway = $this->getTableGateway();

		$product_id = $product->id;

		foreach($product as $field => $value){

			if($this->isValidField($field)){

				$tableGateway->update($product_id, $field, $product->$field);

				$updated_product->$field = $value;
			}


		}
		
		return $updated_product;

	}

	public function delete($product_id)
	{
		$tableGateway = $this->getTableGateway();
		$tableGateway->delete($product_id);
	}

	public function getBy($field, $value)
	{
		$tableGateway = $this->getTableGateway();

		$products = $tableGateway->getBy($field, $value);

		return $products;

	}

	public function isValidField($field)
	{
		$pattern = '/^[A-Za-z0-9_]+$/';

		if(!is_string($pattern) || !preg_match($pattern, $field)){

			return false;
		}

		return true ;

	}

	public function setTableGateway($tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	

	public function getTableGateway()
	{
		return $this->tableGateway;
	}	
}