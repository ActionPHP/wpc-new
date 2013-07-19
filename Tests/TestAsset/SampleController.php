<?php
require_once 'core/lib/Controller/AbstractController.php';
class SampleController extends AbstractController
{
	public function dance_Action()
	{
		return "Thanks, I danced 5 times today!";
	}

	public function dance_now_Action()
	{
		$params = $this->getParams();

		return $params;
	}

	public function dance_type_Action()
	{
		$type = '';

		$type = $this->getParams('type');

		$statement = "Today's dance is $type";
		return $statement;
	}
}