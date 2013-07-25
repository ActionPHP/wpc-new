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
		$product = $this->requestBody();

		$product = (array) $product;

		$this->cart->add($product);

		$this->updateCart(); //!Important!
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
		$item = $this->requestBody();
		$item = json_decode($item);
		return $item;
	}

	public function updateCart()
	{
		$basket =$this->cart->getBasket();

		$_SESSION['wpcart_cart'] = $basket;
	}

}