<?php
require_once 'WPCartVariantTable.php';
require_once 'WPCartVariantOptionsTable.php';
require_once __WPCART_PATH__ . 'core/lib/Table/WPTableGateway.php';

class WPCartVariantManager
{	

	private $variantTable;
	private $variantOptionsTableGateways;
	/*OK, so we have these tables:
	
	ProductTable - gives us the product id
	
	VariantTable

	id | product_id


	VariantOptionsTable
	PK id, variant_id, product_id
	id | variant_id | product_id | option_id | option_value_id

	*/

	public function createVariants()
	{
		$variantTable = $this->getVariantTable();
		
		$variants = $this->getVariants();

		foreach($variants as $variant){

			$variantTable->create($variant);
		
		}
		
	}

	public function createAllVariants()
	{
		
	}


	public function getProductID()
	{
		return $this->product_id;
	}

	public function setProductID($product_id)
	{
		$this->product_id = $product_id;
	}

	public function getVariants()
	{
		return $this->variants;		
	}

	public function setVariants(Array $variants)
	{
		$this->variants= $variants;
	}

	public function getVariantOptionsTableGateway()
	{
		if(!$this->variantOptionsTableGateway){

			$this->variantOptionsTableGateway = new WPTableGateway('WPCartVariantOptions');

		}

		return $this->variantOptionsTableGateway;
	}

	public function getVariantTable()
	{
		if(!$this->variantTable){

			$variantTableGateway = new WPTableGateway('WPCartVariant');
			$this->variantTable = new WPCartVariantTable($variantTableGateway);
		}

		return $this->variantTable;
	}
}