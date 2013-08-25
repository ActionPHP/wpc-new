<?php
	
require_once __WPCART_PATH__ . 'core/lib/Table/Table.php';
require_once __WPCART_PATH__ . 'core/lib/Table/WPTableGateway.php';

class WPCartTransactionTable extends Table
{
	function __construct(){
		
		$tableGateway = new WPTableGateway('WPCartTransaction');
		parent::setTableGateway($tableGateway);

	}	
}