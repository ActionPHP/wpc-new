<?php
///TODO: Come back to this and verify payments properly
require_once __WPCART_PATH__ . 'Modules/Cart/Model/CartTableFactory.php';
require_once __WPCART_PATH__ . 'core/lib/PayPal/WPCartTransactionTable.php';

class WPCartPayPal
{	
	private $paypal_url = 'www.sandbox.paypal.com';
	private $business_email = 'payhere@actionphp.com';
	private $currency = 'USD';
	private $transaction_id;

	function __construct() {
		
		$transactionTable = new WPCartTransactionTable;
		$this->transactionTable = $transactionTable;

		//We need the shopping cart table to ensure the transaction details are
		// correct.
		$cartTableFactory = new CartTableFactory;
		$this->cartTable = $cartTableFactory->cartTable();
	}

	public function process()
	{
		if($this->verify()){

			update_option('aa1', 'Of course it\'s working - just as expected.');

			//Update order Status to 'Payment Complete'
		}
	
	}

	public function verify()
	{
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';

		foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$req .= "&$key=$value";
		}

		// post back to PayPal system to validate
		$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Host: www.sandbox.paypal.com\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen ('ssl://' . $this->paypal_url, 443, $errno, $errstr, 30);

		// assign posted variables to local variables
		$item_name = $_POST['item_name'];
		$item_number = $_POST['item_number'];
		$payment_status = $_POST['payment_status'];
		$payment_amount = $_POST['mc_gross'];
		$payment_currency = $_POST['mc_currency'];
		$txn_id = $_POST['txn_id'];
		$this->transaction_id = $txn_id;
		$receiver_email = $_POST['receiver_email'];
		$payer_email = $_POST['payer_email'];

		$this->cart_id = $_POST['custom'];
		//Let's set cart details - we want to compare this transaction to what we
		// stored at the checkout
		$this->setCartDetails();
		
		$received_data = $_POST;
		
		if (!$fp) {
		// HTTP ERROR
		} else {
		fputs ($fp, $header . $req);
		while (!feof($fp)) {
		$res = fgets ($fp, 1024);
		if (strcmp ($res, "VERIFIED") == 0) {
		// check the payment_status is Completed
		// check that txn_id has not been previously processed
		// check that receiver_email is your Primary PayPal email
		// check that payment_amount/payment_currency are correct
		// process payment
		
		//First let's make sure the payment was properly calculated
		
			if(

				$payment_status == 'Completed' && $this->verifyTransaction($receiver_email,
					$payment_currency, $payment_amount)
				
				){ 	return true;}

		}
		else if (strcmp ($res, "INVALID") == 0) {
		// log for manual investigation
		// 
			return false;

			}
		}
			fclose ($fp);
		}

		update_option('aa2', get_defined_vars());

	}

	public function verifyTransaction()
	{
			if(!$this->transactionExists()){

				return true;
			}

			//&& $receiver_email == $this->business_email
			//&& $payment_currency == $this->currency
			//&& $payment_amount == $this->payment_amount
			
			return false;
			
	}

	public function transactionExists()
	{
		
		//Let's get the transaction from the cart table
		//
		
		$transactionTable = $this->transactionTable;

		$transaction = $transactionTable->get_by('transaction_id', $this->transaction_id);

		if($transaction){

			return true;
		}

		return false;
	}

	public function verifyAmount($amount)
	{
		$cart = $this->getCartDetails;

		$total_amount = $cart->total_amount;

		if($amount = $total_amount){

			return true;
		}

		return false;

	}

	public function verifyBusinessEmail($business_email)
	{
		
	}

	public function verifyCurrency($currency)
	{
		$cart = $this->getCartDetails;

		$transaction_currency = $cart->currency;

		if($transaction_currency == $currency){

			return true;
		}

		return false;

	}

	public function setCartDetails()
	{
		$cartTable = $this->cartTable;
		$cart_id = $this->cart_id;

		$cartDetails = $cartTable->get($cart_id);

		$this->cart = $cartDetails;
	}

	public function getCartDetails()
	{
		return $this->cartDetails;
	}

}

