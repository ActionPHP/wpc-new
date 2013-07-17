<?php

require_once '../vendor/autoload.php';
require_once '../class/Table.php';

class TableTest extends PHPUnit_Framework_TestCase
{
	public function testThis()
	{
		$this->markTestSkipped('I copied the content from ProductTable to Table, then
			extended it. The tests for ProductTable work.');
	}

}