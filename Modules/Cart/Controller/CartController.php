<?php
require_once __WPCART_PATH__ . 'Modules/Cart/Model/Cart.php';
require_once __WPCART_PATH__ . 'core/lib/View/JSONView.php';
class CartController extends AbstractController
{
	public function __construct()
	{
		//Initialize shopping cart
		session_start();
		$cart = new Cart($_SESSION['wpcart_cart']);
		$this->cart = $cart;
	
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
		$basket = $this->cart->getBasket();

		return new JSONView($basket);
	}

	public function getItemId()
	{
		$item = $this->getItemObject();
		$id = $item->id;

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
		foreach($basket as $item){

			$cart[] = $item;
		}

		return $cart;
	}

	public function updateCart()
	{
		$basket =$this->cart->getBasket();

		$_SESSION['wpcart_cart'] = $basket;

		return $basket;
	}

}