<?php
session_start();

require_once __WPCART_PATH__ . 'Modules/Product/Model/ProductFactory.php';
class WPCartShortcodes
{	
	function __construct() {
		$this->create();

	}

	public function create()
	{
		add_shortcode('wpcart_add_to_cart', array($this, 'addButton'));
		add_shortcode('wpcart_buy_now', array($this, 'buyButton'));
		add_shortcode('wpcart_temp_cart', array($this, 'tempCart'));
	}

	public function addButton($args=array())
	{
		$id = $args['id'];

		$productFactory = new ProductFactory;

		$product = $productFactory->product();
		$item = $product->get($id);
		//print_r($item);

		$button = '';

		if($item){

			$price = $item->price;
			
			$button .= '<p style="margin-bottom: 10px;"><strong>Price: <span style="color: #cc0000;">'
			. $price . '</strong></p>';
			$button .= '<input class="wpcart-listing" type="button" value="Add to cart" id="wpcart-item-' . $id . '" />';
	
		}
	
		return $button;
	}

	public function buyButton($args=array())
	{
		$id = $args['id'];

		return '<input class="wpcart-listing" type="button" value="Buy now!" id="wpcart-item-' . $id . '" />';
	}

	public function tempCart()
	{	
		//This uniquely identifies our shopping cart
		$cart_id = $_SESSION['wpcart_cart_id'];

		//$checkout_page = 'wpcart';

		switch ($checkout_page) {
			case 'wpcart':
				
					$action = site_url() . '?checkout';
				
				break;
			
			case 'paypal':

					$action = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

				break;
			default:
					$action = '';//site_url() . '?checkout''';
				
				break;
		}

		$template = '<script type="text/template" id="wpcart-ajax-template" >

		<!-- PayPal details -->
		<input type="hidden" value="<%= product.name %>" name="item_name_1" />
		<input type="hidden" value="<%= product.price %>" name="amount_16" />
	    <input type="hidden" name="quantity_1" value="<%= quantity %>">

		<!-- End of PayPal details -->

		<strong><%= product.name %></strong> 
		(<span style="width: 45px;" class="wpcart-item-quantity" ><%= quantity %></span> item<%= (quantity > 1) ? "s" : "" %> ) 
		<span style="color: #cc0000;" ><span>$</span><span class="item-subtotal" ><%= product.price * quantity %></span> 
		<span class="wpcart-remove-item" >[&times;] </span>

		</script>';

		$notify_url = admin_url() . 'admin-ajax.php?action=wpcart_ipn';
		$cart = $template;

		$cart .= '<div id="wpcart-cart" class="wpcart-basket" >

		<form method="post" action="'. $action . '" >
	    <input type="hidden" name="business" value="payhere@actionphp.com"/>
	    <input type="hidden" name="notify_url" value="' . $notify_url
	    . '"/>
		<input type="hidden" name="cmd" value="_cart"/>
		<input type="hidden" name="upload" value="1"/>
	    <input type="hidden" name="custom"	value="' . $cart_id . '" />

			<ul id="wpcart-cart-basket"></ul>
			
			<div style="padding: 10px;" ><strong>Subtotal: </strong>$<span class="wpcart-subtotal" ></span></div>
			<div id="wpcart-buttons" >
			<input type="hidden" name="wpcart_checkout" value="true" />
			<input type="submit" value="Checkout" />
			</div>

		</form>
		
		</div>';

		return $cart;
	}

	public function listing()
	{

	}
	

}