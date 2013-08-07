<?php
require_once __WPCART_PATH__ . 'core/lib/Table/Table.php';

class WPCartVariantOptionsTable extends Table
{
	public function __construct($tableGateway)
	{
		parent::setTableGateway($tableGateway);
	}
}