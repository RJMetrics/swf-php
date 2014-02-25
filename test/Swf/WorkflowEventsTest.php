<?php

class WorkflowEventsTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		$testEvents = json_decode('
[
	{
		"eventId":1,
		"eventTimestamp":1391635187.818,
		"eventType":"WorkflowExecutionStarted",
		"workflowExecutionStartedEventAttributes":{
			"workflowType":{
				"name":"TestWorkflow",
				"version":"0.1"
			}
		}
	},
	{
		"eventId":5,
		"activityTaskScheduledEventAttributes":{
			"activityType":{
				"name":"MyActivity",
				"version":"0.2"
			},
			"taskList":{
				"name":"my_task_list"
			}
		},
		"eventTimestamp":1391635188.779,
		"eventType":"ActivityTaskScheduled"
	},
	{
		"eventId":6,
		"activityTaskStartedEventAttributes":{
			"scheduledEventId":5
		},
		"eventTimestamp":1391635188.819,
		"eventType":"ActivityTaskStarted"
	},
	{
		"eventId":7,
		"activityTaskCompletedEventAttributes":{
			"result":"My Result",
			"scheduledEventId":5,
			"startedEventId":6
		},
		"eventTimestamp":1391635188.958,
		"eventType":"ActivityTaskCompleted"
	},
	{
		"eventId":11,
		"eventTimestamp":1391635189.117,
		"eventType":"WorkflowExecutionCompleted",
		"workflowExecutionCompletedEventAttributes": {
			"result": "myresult"
		}
	}
]', true);
		$this->rawEvents = $testEvents;
		$this->history = new \Swf\WorkflowEvents($testEvents);
	}

	/**
	 * @test
	 */
	public function getEventById() {
		$this->assertEquals(
			1391635188.958,
			$this->history->getEventById(7)->getTimestamp());
	}

	/**
	 * @test
	 */
	public function getEventById_exception() {
		$this->setExpectedException('\Swf\Exception\NotFoundException');
		$this->history->getEventById(999);
	}

	/**
	 * @test
	 */
	public function getWorkflowStartedEvent() {
		$this->assertEquals(1, $this->history->getWorkflowStartedEvent()->getId());
	}

	/**
	 * @test
	 */
	public function getWorkflowStoppedEvent() {
		$this->assertEquals(11, $this->history->getWorkflowStoppedEvent()->getId());
	}

	/**
	 * @test
	 */
	public function getAllActivityStartedEvents() {
		$events = $this->history->getAllActivityStartedEvents();
		$this->assertEquals(1, count($events));
		$this->assertEquals('Swf\Event\ActivityStarted', get_class($events[0]));
	}

	/**
	 * @test
	 */
	public function getAllActivityStoppedEvents() {
		$events = $this->history->getAllActivityStoppedEvents();
		$this->assertEquals(1, count($events));
		$this->assertEquals('Swf\Event\ActivityCompleted', get_class($events[0]));
	}

}

?>
