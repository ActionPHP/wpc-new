<?php
//session_start();
class Cart
{

	public function __construct($basket)
	{
		$basket = (isset($basket)) ? $basket : array();
		$this->setBasket($basket);
	}

	/**
	 * Adds products to basket
	 * @param array  $product  an array containing id, and other charactertics of
	 * product
	 * @param integer $quantity qunatity of product
	 */
	public function add(Array $product, $quantity=1)
	{
		$basket = $this->getBasket();
		$product_id = $product['id'];
		
		//If the product is not yet in basket.
		if(!isset($basket[$product_id])){

			$basket[$product_id]['product'] = array();
			$basket[$product_id]['quantity'] = 0;
		}

		$basket[$product_id]['product'] = $product;
		$basket[$product_id]['quantity'] += $quantity;

		$this->setBasket($basket);

		return $basket;

	}

	public function getItem($product_id)
	{
		$basket = $this->getBasket();
		$item = $basket[$product_id];
		return $item;
	}
	public function changeQuantity($product_id, $quantity)
	{
		$basket = $this->getBasket();
		$basket[$product_id]['quantity'] = $quantity;
		$this->setBasket($basket);

	}

	public function remove($product_id)
	{
		$basket = $this->getBasket();
		unset($basket[$product_id]);

		$this->setBasket($basket);
	}

	public function emptyBasket()
	{
		$empty  = array();
		$this->setBasket($empty);
	}
	
	public function setBasket($basket)
	{
		$this->basket = $basket;
	}

	public function getBasket()
	{
		return $this->basket;
	}

}