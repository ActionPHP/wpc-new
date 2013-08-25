<?php
require_once 'core/lib/View/HTMLView.php';
class CheckoutController  extends AbstractController

{

	public function index_Action()
	{
		$data = array('where' => 'checkout');
		return new HTMLView($data);
	}
}