<?php

class WorkflowCompleted extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	public function getResult() {
		$json = [
			'eventId' => 12,
			'eventType' => 'WorkflowExecutionCompleted',
			'eventTimestamp' => 1392752400,
			'workflowExecutionCompletedEventAttributes' => [
				'result' => 'myresult',
			],
		];
		$event = new \Swf\Event\WorkflowCompleted($json);
		$this->assertEquals('myresult', $event->getResult());
	}

}

?>
