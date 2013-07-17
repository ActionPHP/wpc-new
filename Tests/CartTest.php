<?php
echo getcwd();

require_once 'vendor/autoload.php';
require_once 'Modules/Cart/Model/Cart.php';

class CartTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
		$basket = array();
		$this->cart = new Cart($basket);
	}

	function tearDown()
	{

	}

	public function testAddingAProductIncreasesByOne()
	{
		$product = array(
				'name' => 'Product 1',
				'id' => 1,
				'sku' => 'ABC1',
			);

		$basket_before = $this->cart->getBasket();
		$count_1 = count($basket_before);

		$this->cart->add($product);
		
		$basket_after = $this->cart->getBasket();
		$count_2 = count($basket_after);
		
		$count_difference = $count_2 - $count_1;
		//Since we added just one product we want the difference to be 1
		$this->assertEquals(1, $count_difference);

	}

	public function testAddingItemToBasketSetsTheBasket()
	{
		$product = array(
				'name' => 'Product 1',
				'id' => 1,
				'sku' => 'ABC1',
			);

		$basket_before = $this->cart->getBasket();

		$basket = $this->cart->add($product);
		
		$basket_after = $this->cart->getBasket();

		$this->assertEquals($basket, $basket_after);

	}

	public function testAddingProductsWithTheSameIdIncreasesTheirCount()
	{
		$product = array(
				'name' => 'Product 1',
				'id' => 1,
				'sku' => 'ABC1',
			);

		$basket = array( 1 => array(

				'product' => $product,
				'quantity' => 3,

			));

		$this->cart->setBasket($basket);

		$new_basket = $this->cart->add($product);
		$quantity = $new_basket[1]['quantity'];

		$this->assertEquals(4, $quantity);


	}

	public function testAddingAQuantityOfAnItem()
	{
		$product_id = 1;

		$quantity = 2;

		$product = array(
				'name' => 'Product 1',
				'id' => $product_id,
				'sku' => 'ABC1',
			);

		$basket = array( $product_id => array(

				'product' => $product,
				'quantity' => 3,

			));

		$this->cart->setBasket($basket);

		$this->cart->add($product, 2);
		$new_basket = $this->cart->getBasket();

		$this->assertEquals(5, $new_basket[$product_id]['quantity']);

	}

	public function testRemovingAnItemFromBasket()
	{
		$product_id = 1;

		$product = array(
				'name' => 'Product 1',
				'id' => $product_id,
				'sku' => 'ABC1',
			);

		$basket = array( $product_id => array(

				'product' => $product,
				'quantity' => 3,

			));

		$this->cart->setBasket($basket);

		$this->cart->remove($product_id);

		$new_basket = $this->cart->getBasket();

		$this->assertEquals(array(), $new_basket);
	}

	public function testChangingItemQuantity()
	{

		$product_id = 1;

		$quantity = 2;

		$product = array(
				'name' => 'Product 1',
				'id' => $product_id,
				'sku' => 'ABC1',
			);

		$basket = array( $product_id => array(

				'product' => $product,
				'quantity' => 3,

			));

		$this->cart->setBasket($basket);

		$this->cart->changeQuantity($product_id, $quantity);
		$new_basket = $this->cart->getBasket();

		$this->assertEquals(2, $new_basket[$product_id]['quantity']);



	}

	public function testEmptyBasketRemovesAllItems($value='')
	{
		$product_id = 1;

		$product = array(
				'name' => 'Product 1',
				'id' => $product_id,
				'sku' => 'ABC1',
			);

		$basket = array( $product_id => array(

				'product' => $product,
				'quantity' => 3,

			));

		$this->cart->setBasket($basket);

		$this->cart->emptyBasket();

		$new_basket = $this->cart->getBasket();

		$this->assertEquals(array(), $new_basket);
	}

	public function testGetItemByIdReturnsItemFromBasket()
	{
		$product_id = 1;

		$product = array(
				'name' => 'Product 1',
				'id' => $product_id,
				'sku' => 'ABC1',
			);

		$item = array(

				'product' => $product,
				'quantity' => 3,

			);

		$basket = array( 1 => $item, );

		$this->cart->setBasket($basket);

		$new_basket = $this->cart->getBasket();

		$new_item = $this->cart->getItem($product_id);

		$this->assertEquals($item, $new_item );
	}
}