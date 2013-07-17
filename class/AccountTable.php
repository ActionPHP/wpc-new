<?php

require_once '../class/Table.php';

class AccountTable extends Table
{
	public function __construct($tableGateway)
	{
		parent::setTableGateway($tableGateway);
	}
		
}