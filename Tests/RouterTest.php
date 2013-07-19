<?php
require_once 'vendor/autoload.php';
require_once 'core/lib/Router/Router.php';
require_once 'core/lib/Router/Route.php';

class RouterTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->router = new Router;

		$route = new Route;

		$route->Module = 'Product';
		$route->Controller = 'ProductController';
		$route->Action = 'update';
		$route->Params = array(

				'id' => 1

			);

		$this->router->setRoute($route);
		$this->router->setControllerFolder();
		$this->router->setModulesPath('../Modules');
	}

	public function tearDown()
	{
		# code...
	}

	public function testRouteActionMatches()
	{
		$expected_action = 'update';

		$this->assertEquals($expected_action, $this->router->getRouteAction());

	}

	public function testRouteModuleMatches()
	{
		$expected_module = 'Product';
		$this->assertEquals($expected_module, $this->router->getRouteModule() );
	}

	public function testRouteControllerMatches()
	{
		$expected_controller = 'ProductController';
		$this->assertEquals($expected_controller, $this->router->getRouteController() );
	}

	public function testRouteControllerPathMatches()
	{
		# code...
	}

	public function testRouteParamsMatch()
	{
		$expected_params = array(

				'id' => 1

			);

		$this->assertEquals($expected_params, $this->router->getRouteParams() );
		$this->assertTrue(is_array($this->router->getRouteParams()));
	}

	public function testExecutingRouteWorks()
	{
		$this->markTestSkipped('Not sure how to test this since it should not output
			anything');


		$output = json_encode(array(

					'test' => 'successful'

			));

		$this->assertEquals($output, $this->router->execute() );
	}
}
