<?php

require 'core/lib/View/JSONView.php';
require_once 'core/lib/Table/Table.php';
class ProductController extends AbstractController
{	
	public function index_Action()
	{
		$params = $this->getParams();

		$products = array(

				array(

					'id' => 1,
					'name' => 'WPCart Premium',
					'price' => '297',
					'description' => 'Your Fast & Easy Wordpress Shopping Cart',
					'brief_description' => 'Wordpress Shopping Cart',

					),

				array(

					'id' => 1,
					'name' => 'WPCart Supreme',
					'price' => '497',
					'description' => 'Your Fast & Easy Wordpress Shopping Cart',
					'brief_description' => 'Wordpress Shopping Cart Extended Version',

					),

				array(

					'id' => 1,
					'name' => 'WPCart Premium',
					'price' => '997',
					'description' => 'Your Fast & Easy Wordpress Shopping Cart',
					'brief_description' => 'Wordpress Shopping Cart Super Mogul Version',

					),

			);


		return new JSONView($products);
	}

	public function save_Action()
	{
		$body = file_get_contents('php://input');
		$body = json_decode($body);
		$body->id = 1;

		$body = (array) $body;
		//print_r($body);

		return new JSONView($body);
	}

	public function update_Action()
	{
		
	}

	public function productTable()
	{

	}
}