<?php
require 'core/lib/Wordpress/WPCartWordpress.php';
class WPCartWordpressTest extends PHPUnit_Framework_TestCase
{

	function setUp(){

		$wpcart = new WPCartWordpress;
		$this->wpcart = $wpcart;

	}

	public function testActionSlugCreatesNoPrivSlug()
	{
		$wpcart = $this->wpcart;

		$slug = $wpcart->ajax_slug('your_action', true);

		$expected = 'wp_ajax_nopriv_your_action';

		$this->assertEquals($expected, $slug );
	}

	public function testActionSlugCreatesAdminPrivSlug()
	{
		$wpcart = $this->wpcart;

		$slug = $wpcart->ajax_slug('your_action', false);

		$expected = 'wp_ajax_your_action';

		$this->assertEquals($expected, $slug );
	}#

	/**
	 * @expectedException Exception
	 */
	public function testExceptionThrownIfWrongActionIsProvided()
	{
		$wpcart = $this->wpcart;

		$slug = $wpcart->ajax_slug(' {$$your_action');

		
	}

	/**
	 * @expectedException Exception
	 */
	public function testExceptionThrownIfNoActionIsProvided()
	{
		$wpcart = $this->wpcart;

		$slug = $wpcart->ajax_slug('');

		
	}

}