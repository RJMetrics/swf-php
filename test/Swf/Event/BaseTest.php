<?php

class BaseTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	public function success() {
		$json = [
			'eventId' => 1,
			'eventType' => 'ActivityTaskStarted',
			'eventTimestamp' => 1392752400,
		];
		$event = new \Swf\Event\Base($json);
		$this->assertEquals(1, $event->getId());
		$this->assertEquals('ActivityTaskStarted', $event->getType());
		$this->assertEquals(1392752400, $event->getTimestamp());
		$this->assertEquals('2014-02-18 14:40:00', $event->getDateString());
	}

	/**
	 * @test
	 */
	public function malformed() {
		$json = [
			'noEventId' => 2,
			'eventType' => 'ActivityTaskStarted',
			'eventTimestamp' => 1392752400,
		];
		$this->setExpectedException('Swf\Exception\MalformedJsonException');
		$event = new \Swf\Event\Base($json);
	}

}

?>
