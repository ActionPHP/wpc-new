<?php
require_once '../vendor/autoload.php';
require_once '../class/Product.php';

class ProductTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
		$table = $this->_table();
		$this->product = new Product($table);

		$item = new stdClass();

		$item->id = 1;
		$item->name = "Audi RS5";
		$item->description = "Exquisite car for smart, intelligent men.";
		$item->short_description = "Latest gift for you";
		$item->price = "69700.00";
		$item->currency = "GBP";
		$item->sku ="AD2347B";
		$item->category = 7;

		$this->item = $item;

	}

	public function tearDown()
	{
		$this->item = new stdClass();
	}

	public function testCreatingNewProductReturnsProductId()
	{
		$item = $this->item;
		$item_id = $this->product->create($item);

		$this->assertEquals(1, $item_id);
	}

	public function testGetWithIdReturnsSingleProduct()
	{
		$item_id = 1;

		$expected_item = $this->item;
		$item = $this->product->get($item_id);

		$isArray = is_array($item_id);
		$this->assertFalse($isArray);
		$this->assertEquals($expected_item, $item);
	}

	public function testGetWithoutIdReturnsAllProducts($value='')
	{
		$items = $this->product->get();

		$isArray = is_array($items);
		$this->assertTrue($isArray);
	}

	public function testUpdatingProductReturnsUpdatedProduct()
	{
		$item = $this->item;

		$item->name = "updated";

		$updated_item = $this->product->update($item);
		$this->assertEquals("updated", $updated_item->name);

	}

	public function _table()
	{
		$_table = \Mockery::mock('ProductTable');

		$item = new stdClass();

		$item->id = 1;
		$item->name = "Audi RS5";
		$item->description = "Exquisite car for smart, intelligent men.";
		$item->short_description = "Latest gift for you";
		$item->price = "69700.00";
		$item->currency = "GBP";
		$item->sku ="AD2347B";
		$item->category = 7;

		$updated_item = clone $item;

		$updated_item->name = "updated";

		
		$_table->shouldReceive('get')->with(null)->andReturn(array($item));
		$_table->shouldReceive('get')->with(1)->andReturn($item);
		$_table->shouldReceive('create')->andReturn(1);
		$_table->shouldReceive('update')->andReturn($updated_item);

		return $_table;
	}
}