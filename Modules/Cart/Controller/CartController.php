<?php
require_once __WPCART_PATH__ . 'Modules/Cart/Model/Cart.php';
require_once __WPCART_PATH__ . 'Modules/Product/Model/ProductFactory.php';
require_once __WPCART_PATH__ . 'core/lib/View/JSONView.php';
class CartController extends AbstractController
{
	public function __construct()
	{
		//Initialize shopping cart
		session_start();
		$cart = new Cart($_SESSION['wpcart_cart']);
		$this->cart = $cart;

		$product_factory = new ProductFactory;
		$this->product = $product_factory->product();
	
	}

	public function add_Action()
	{
		$product = $this->getPost();
	
		$this->cart->add($product);

		$cart = $this->cartArray();

		return new JSONView($cart);
	}

	public function remove_Action()
	{
		$id = $this->getItemId();

		$this->cart->remove($id);

		$this->updateCart();//!important!
	}

	public function quantity_Action()
	{
		$item = $this->getItemObject();

		$id = $item->id;
		$quantity = $item->quantity;

		$this->cart->changeQuantity($id, $quantity);

		$this->updateCart(); //!important!

	}

	public function empty_Action()
	{
		$this->cart->emptyBasket();
		$this->updateCart();

	}

	public function index_Action()
	{
		$basket = $this->cartArray();

		return new JSONView($basket);
	}

	public function getItemId()
	{
		if(isset($_GET['item_id'])){

			$id = $_GET['item_id'];
		} else {

			$item = $this->getItemObject();
			$id = $item->id;
		}
		
		return $id;
	}

	public function getItemObject()
	{
		$item = $this->getPost();

		$item = (object) $item;
		return $item;
	}

	public function cartArray()
	{
		$basket = $this->updateCart(); //!Important!
		//The basket is an associative array - we just want a simple array so we can
		// use it as a collection for backbone
		// 
		
		$cart = array();

		foreach($basket as $item){

			$item_id = $item['id'] = $item['product']['id'];
			$item_details = $this->productDetails($item_id);
			$item['product'] = (array) $item_details;
			$cart[] = $item;
			//$cart[] = (array) $item_details;
		}

		return $cart;
	}

	public function updateCart()
	{
		$basket =$this->cart->getBasket();

		$_SESSION['wpcart_cart'] = $basket;

		return $basket;
	}

	public function productDetails($item_id)
	{
		$product_details = $this->product->get($item_id);
		return $product_details;
		//print_r($product_details);
	}

	public function getProductTable()
	{
		
	}

}