<?php

require_once 'core/lib/Table/Table.php';

class AccountTable extends Table
{
	public function __construct($tableGateway)
	{
		parent::setTableGateway($tableGateway);
	}
		
}