<?php
require_once 'WPCartVariantTable.php';
require_once 'WPCartVariantOptionsTable.php';
require_once __WPCART_PATH__ . 'core/lib/Table/WPTableGateway.php';

class WPCartVariantManager
{	

	private $variantTableGateway;
	private $variantOptionsTableGateways;
	/*OK, so we have these tables:
	
	ProductTable - gives us the product id
	
	VariantTable

	id | product_id


	VariantOptionsTable
	PK id, variant_id, product_id
	id | variant_id | product_id | option_id | option_value_id

	*/

	public function createVariantOptions($variant)
	{
		$variantOptionsTable = $this->getVariantOptionsTableGateway();
		var_dump($variantOptionsTable);
		$variant_id = $variant->id;
		$product_id = $variant->product_id;
		$variant_options = $variant->options;

		foreach ($variant_options as $option_id => $option_value_id){
			
			$updated_id = $variantOptionsTable->create($variant_id, 'variant_id');
			$variantOptionsTable->update($updated_id, 'option_id', $option_id);

			//Because we're using a sligthly complex EAV pattern, we will add the
			// product id for easier reading.
			$variantOptionsTable->update($updated_id, 'product_id', $product_id );
			$variantOptionsTable->update($updated_id, 'option_value_id',$option_value_id);
		}
		
		
	}

	public function generateVariants()
	{
		
		$variantTable = $this->getVariantTableGateway();
		$variantOptions = $this->getVariantOptions();
		$product_id = $this->getProductID();
		
		$product = new stdClass();
		$product->id = $product_id;var_dump($product);
		foreach ($variantOptions as $options ){

			$variant = new stdClass();

			$variant_id = $variantTable->create($product_id, 'product_id');
			
			$variant->id = $variant_id;
			$variant->product_id = $product_id;
			$variant->options = $options;

			$this->createVariantOptions($variant);
		}
		print_r(get_defined_vars());
	}

	/**
	 * Generates all variant options based on the options given. 
	 * @param  Array  $options Array of available options for a given product. 
	 * Format: array( 'key' => array( 'value1', 'value2'), 'key2' => array( 'value3', 'value4')) 
	 *
	 * @return Array            An array of all possible product permutations,
	 * based on the product options.
	 */
	public function generateVariantOptions(Array $options) {

    $permutations = array();
    $iter = 0;
    $current = array();

    while (true) {

        $num = $iter++;
        $pick = array();

        foreach ($options as $key => $l) {

        	$r = $num % count($l);
            $num = ($num - $r) / count($l);

            $pick[$key] = $l[$r];

        }

        if ($num > 0) break;
        $permutations[] = $pick;

    }

    return $permutations;
	
	}

	public function getProductID()
	{
		return $this->product_id;
	}

	public function setProductID($product_id)
	{
		$this->product_id = $product_id;
	}

	public function getVariantOptions()
	{
		return $this->variantOptions;		
	}

	public function setVariantoptions($variantOptions)
	{
		//We will generate all combinations for variant options
		$variantOptions = $this->generateVariantOptions($variantOptions);
		$this->variantOptions = $variantOptions;
	}

	public function getVariantOptionsTableGateway()
	{
		if(!$this->variantOptionsTableGateway){

			$this->variantOptionsTableGateway = new WPTableGateway('WPCartVariantOptions');
			//$this->variantOptionsTable = new WPCartVariantOptionsTable($tableGateway);

		}

		return $this->variantOptionsTableGateway;
	}

	public function getVariantTableGateway()
	{
		if(!$this->variantTableGateway){

			$this->variantTableGateway = new WPTableGateway('WPCartVariant');
			//$this->variantTable = new WPCartVariantTable($tableGateway);

		}

		return $this->variantTableGateway;
	}
}