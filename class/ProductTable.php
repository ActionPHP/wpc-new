<?php
require_once '../interface/TableInterface.php';
require '../class/Table.php';

class ProductTable extends Table
{
	public function __construct($tableGateway)
	{
		parent::setTableGateway($tableGateway);
	}
}