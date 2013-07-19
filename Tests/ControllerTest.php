<?php
require_once 'core/lib/Controller/AbstractController.php';
require_once 'TestAsset/SampleController.php';

class ControllerTest extends PHPUnit_Framework_TestCase
{
	public function setUp($value='')
	{
		$controller = new SampleController;
		$this->controller = $controller;
	}

	public function testActionExistsInController()
	{
		$action = 'dance-now';

		$this->controller->setAction($action);
		$this->assertTrue($this->controller->validateAction());
	}

	/**
	 * @expectedException Exception
	 */
	public function testThrowExceptionIfMethodDoesNotExist()
	{
		$action = 'jump';
		$this->controller->setAction($action);
		$this->controller->validateAction();

	}

	public function testControllerReceivesParams()
	{
		$params = array(

				'type' => 'hip-hop',
				'steps' => (object)	array(
						'slide' => "electrically",
						'drop_it'=> "like it's hot",
					),
				'repeat' => 5,
				'id' => 2,

			);

		$this->controller->setAction('dance-now');
		$this->controller->setParams($params);

		$output = $this->controller->invoke();

		$this->assertEquals($params, $output);
	}

	public function testInvokedMethodReturnsExpectedValue($value='')
	{
		$expected = "Thanks, I danced 5 times today!";

		$this->controller->setAction('dance');
		$output = $this->controller->invoke();

		$this->assertEquals($expected, $output );
	}

	public function testControllerActionComputesParams()
	{
		$params = array(

				'type' => 'hip-hop',
				'steps' => (object)	array(
						'slide' => "electrically",
						'drop_it'=> "like it's hot",
					),
				'repeat' => 5,
				'id' => 2,

			);
		$expected = "Today's dance is hip-hop";

		$this->controller->setAction('dance-type');
		$this->controller->setParams($params);

		$output = $this->controller->invoke();

		$this->assertEquals($expected, $output );
	}

}
