<?php

require_once '../interface/TableInterface.php';

class Table implements TableInterface
{
	public function __construct($tableGateway)
	{
		$this->setTableGateway($tableGateway);
	}
	
	public function create($item)
	{
		$tableGateway = $this->getTableGateway();
		
		//Let's get the item id
		$item_id = $tableGateway->create($item->name);
		$item->id = $item_id;

		$this->update($item);


		return $item_id;
	}

	public function get($item_id = null)
	{
		
		$tableGateway = $this->getTableGateway();
		$item = $tableGateway->get($item_id);
		return $item;


	}

	public function update($item)
	{
		
		$tableGateway = $this->getTableGateway();

		$item_id = $item->id;

		foreach($item as $field => $value){

			if($this->isValidField($field)){

				$tableGateway->update($item_id, $field, $item->$field);

				$updated_item->$field = $value;
			}


		}
		
		return $updated_item;

	}

	public function delete($item_id)
	{
		$tableGateway = $this->getTableGateway();
		$tableGateway->delete($item_id);
	}

	public function getBy($field, $value)
	{
		$tableGateway = $this->getTableGateway();

		$items = $tableGateway->getBy($field, $value);

		return $items;

	}

	public function isValidField($field)
	{
		$pattern = '/^[A-Za-z0-9_]+$/';

		if(!is_string($pattern) || !preg_match($pattern, $field)){

			return false;
		}

		return true ;

	}

	public function setTableGateway($tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	

	public function getTableGateway()
	{
		return $this->tableGateway;
	}	
}