<?php

class ActivityCompletedTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	public function properlyFormed() {
		$json = [
			'eventId' => 10,
			'eventType' => 'ActivityTaskCompleted',
			'eventTimestamp' => 1392752400,
			'activityTaskCompletedEventAttributes' => [
				'scheduledEventId' => 7,
				'startedEventId' => 8,
			],
		];
		$event = new \Swf\Event\ActivityCompleted($json);
		$this->assertEquals(7, $event->getScheduledEventId());
		$this->assertEquals(8, $event->getStartedEventId());
		$this->assertTrue($event->wasSuccessful());
		$this->assertNull($event->getErrorMessage());
	}

	/**
	 * @test
	 */
	public function noAttributes() {
		$json = [
			'eventId' => 10,
			'eventType' => 'ActivityTaskCompleted',
			'eventTimestamp' => 1392752400,
		];
		$this->setExpectedException('Swf\Exception\MalformedJsonException');
		$event = new \Swf\Event\ActivityCompleted($json);
	}

}

?>
