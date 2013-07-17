<?php
require_once 'vendor/autoload.php';
require_once 'Modules/Product/Model/ProductTable.php';
class ProductTableTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$tableGateway = $this->_tableGateway();

		$product = new stdClass();

		$product->name = "Mac Pro";
		$product->description = "Professional computer for rich people.";
		$product->short_description = 'Pro PC';
		$product->sku = 'ABC123';
		$product->category_id = 2;
		$product->prototype_id = 4;
		$product->image = 'image.jpg';
		$product->tags = '{"tag1","tag2","tag3"}';
		$product->price = 2997.00;

		$this->product = $product;

		$this->productTable = new ProductTable($tableGateway);
	}

	public function tearDown()
	{
		
	}

	public function testCreatingProductReturnsId()
	{
		$product = new stdClass();

		$product->name = "Mac Pro";
		$product->description = "Professional computer for rich people.";
		$product->short_description = 'Pro PC';
		$product->sku = 'ABC123';
		$product->category_id = 2;
		$product->prototype_id = 4;
		$product->image = 'image.jpg';
		$product->tags = '{"tag1","tag2","tag3"}';
		$product->price = 2997.00;


		$product_id = $this->productTable->create($product);

		$this->assertEquals(1, $product_id);
		
	}

	public function testGetProductWithIdReturnsOneProduct()
	{
		$productTable = $this->productTable;
		$product_id = 1;
		$product = $productTable->get($product_id);

		$expected_product = new stdClass();

		$expected_product->name = "Mac Pro";
		$expected_product->description = "Professional computer for rich people.";
		$expected_product->short_description = 'Pro PC';
		$expected_product->sku = 'ABC123';
		$expected_product->category_id = 2;
		$expected_product->prototype_id = 4;
		$expected_product->image = 'image.jpg';
		$expected_product->tags = '{"tag1","tag2","tag3"}';
		$expected_product->price = 2997.00;
		$expected_product->id = 1;

		$this->assertEquals($expected_product, $product );
		$this->assertFalse(is_array($product));

	}

	public function testGetByFieldReturnsProductArray()
	{	
		$product = new stdClass();

		$product->name = "Mac Pro";
		$product->description = "Professional computer for rich people.";
		$product->short_description = 'Pro PC';
		$product->sku = 'ABC123';
		$product->category_id = 2;
		$product->prototype_id = 4;
		$product->image = 'image.jpg';
		$product->tags = '{"tag1","tag2","tag3"}';
		$product->price = 2997.00;
		$product->id = 1;

		$expected_products = array();

		$expected_products[] = $product;

		$field = 'sku';
		$value = 'ABC123';
		$products = $this->productTable->getBy($field, $value);

		$this->assertTrue(is_array($products));
		$this->assertEquals($expected_products, $products);

	}

	public function testGetProductWithoutIdReturnsAllProducts()
	{
		$product = new stdClass();

		$product->name = "Mac Pro";
		$product->description = "Professional computer for rich people.";
		$product->short_description = 'Pro PC';
		$product->sku = 'ABC123';
		$product->category_id = 2;
		$product->prototype_id = 4;
		$product->image = 'image.jpg';
		$product->tags = '{"tag1","tag2","tag3"}';
		$product->price = 2997.00;
		$product->id = 1;

		$expected_products = array();

		$expected_products[] = $product;

		$products = $this->productTable->get();

		$this->assertEquals($expected_products, $products );
		$this->assertTrue(is_array($products));
	}

	public function testUpdatingAProductReturnsUpdatedProduct()
	{
		$product = new stdClass();

		$product->name = "Mac Pro";
		$product->description = "Professional computer for rich people.";
		$product->short_description = 'Pro PC';
		$product->sku = 'ABC123';
		$product->category_id = 2;
		$product->prototype_id = 4;
		$product->image = 'image.jpg';
		$product->tags = '{"tag1","tag2","tag3"}';
		$product->price = 2997.00;
		$product->id = 1;

		$product->name = 'updated';

		$updated_product = $this->productTable->update($product);

		$this->assertEquals($product, $updated_product);
	}

	public function _tableGateway()
	{
		$tableGateway = \Mockery::mock('TableGateway');

		$product = new stdClass();

		$product->name = "Mac Pro";
		$product->description = "Professional computer for rich people.";
		$product->short_description = 'Pro PC';
		$product->sku = 'ABC123';
		$product->category_id = 2;
		$product->prototype_id = 4;
		$product->image = 'image.jpg';
		$product->tags = '{"tag1","tag2","tag3"}';
		$product->price = 2997.00;
		$product->id = 1;

		$products = array( $product );


		$updated_product = clone $product;
		$updated_product->name = 'updated';

		$tableGateway->shouldReceive('create')->andReturn(1);
		$tableGateway->shouldReceive('get')->with(1)->andReturn($product);
		$tableGateway->shouldReceive('get')->with(null)->andReturn($products);
		$tableGateway->shouldReceive('update');
		$tableGateway->shouldReceive('getBy')->with('sku', 'ABC123')->andReturn($products);


		return $tableGateway;
	}
}