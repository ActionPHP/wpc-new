<?php

require 'core/lib/View/JSONView.php';
class ProductController extends AbstractController
{	
	public function index_Action()
	{
		$params = $this->getParams();

		return new JSONView($params);
	}

	public function update_Action()
	{
		
	}
}