<?php

class Event
{

	private static $events = array();
	private static $instance;
	private function __construct()
	{
		# code...
	}

	public function on($trigger, $class, $method)
	{
		if(!isset(self::$events[$trigger])){

			self::$events[$trigger] = new stdClass();
			self::$events[$trigger]->class = $class;
			self::$events[$trigger]->method = $method;

		}
	}

	public function trigger($trigger, $params = array())
	{

		if(isset(self::$events[$trigger])){
			
			$class = self::$events[$trigger]->class;
			$method = self::$events[$trigger]->method;

			if($method){
				
				call_user_func_array(array($class, $method), $params);

			}
		}
	}

	public static function event()
	{
		if(!self::$instance){
			self::$instance = new Event();
		}
		return self::$instance;
	}
}