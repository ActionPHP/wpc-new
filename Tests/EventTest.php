<?php

require_once 'core/lib/Event/Event.php';
require_once 'TestAsset/SampleClass.php';

class EventTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$event = Event::event();
		$this->event = $event;
	}

	public function testStoredEventIsTriggeredAndReturnsExpectedOutput()
	{	
		$this->event->on('jump', new SampleClass, 'jump' );

		$this->event->trigger('jump', array(5));

		$this->expectOutputString("Jump 5 metres up!");
	}


}