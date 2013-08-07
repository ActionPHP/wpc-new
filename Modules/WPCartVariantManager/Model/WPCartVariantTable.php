<?php
require_once __WPCART_PATH__ . 'core/lib/Table/Table.php';

class WPCartVariantTable extends Table
{
	public function __construct($tableGateway)
	{
		parent::setTableGateway($tableGateway);
	}
}