<?php

class WPCartPayPal
{	
	private $paypal_url = 'www.sandbox.paypal.com';
	private $business_email = 'payhere@actionphp.com';
	private $currency = 'USD';
	private $transaction;



	public function process()
	{
		if($this->verify()){

			update_option('aa1', 'Of course it\'s working - just as expected.');
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
		$this->transaction = $txn_id;
		$receiver_email = $_POST['receiver_email'];
		$payer_email = $_POST['payer_email'];

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

				$payment_status == 'Completed' 
				&& !$this->transactionExists()
				&& $receiver_email == $this->business_email
				&& $payment_currency == $this->currency
				&& $payment_amount == $this->payment_amount
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

	public function transactionExists()
	{
		$transaction = $this->transaction;

		return false;
	}
}

