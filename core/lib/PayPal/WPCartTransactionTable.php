<?php
	
require_once '../Table/Table.php';
require_once '../Table/WPTableGateway.php';

class WPCartTransactionTable extends Table
{
	function __construct(){
		
		$tableGateway = new WPTableGateway('WPCartTransaction');
		parent::setTableGateway($tableGateway);

	}	
}