<?php
require_once 'core/lib/View/HTMLView.php';
class CheckoutController extends AbstractController

{

	public function index_Action()
	{	
		
		$data = array('where' => 'checkout');

		$view = new HTMLView($data);
		print_r(Registry::getInstance());
		return new HTMLView($data);
	}
}