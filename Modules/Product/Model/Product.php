<?php

/**
* Used to manage products by interacting with a Table class.
*/
class Product
{
	
	function __construct($table=null)
	{
		$this->setTable($table);
	}
	/**
	 * Creates a product by passing it to a Table class.
	 * @param  object $item an object containg the item and it's properties.
	 * @return int       The id of the product that was just created.
	 */
	public function create($item)
	{
		$table = $this->getTable();
		$item_id = $table->create($item);
		return $item_id; 
	}

	public function get($id=null)
	{
		$table = $this->getTable();
		$item = $table->get($id);
		return $item;

	}

	public function update($item)
	{
		$table = $this->getTable();
		$updated = $table->update($item);
		return $updated;
	}

	public function delete($id)
	{
		$table = $this->getTable();

		$table->delete($id);
	}
	
	public function setTable($table)
	{
		$this->table = $table;
	}

	public function getTable()
	{
		return $this->table;
	}	

}