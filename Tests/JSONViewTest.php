<?php
require 'core/lib/View/JSONView.php';

class JSONViewTest extends PHPUnit_Framework_TestCase
{	
	public function setUp()
	{
	}

	public function testViewReturnsTheRightJSON()
	{
		$data = array(

			'customer_id' => 1,
			'product' => (object) array(

				'name' => 'WPCart Premium',
				'price' => '297',
				'currency' => 'USD',

				),
			);

		$expected = json_encode($data);

		$view = new JSONView($data);
		$output = $view->render();

		$this->assertEquals($expected, $output );

	}

	/**
	 * @expectedException Exception
	 */
	public function testThrowExceptionIfDataIsNotAnArray()
	{
		$data = '$data';

		$view = new JSONView($data);

	}
}