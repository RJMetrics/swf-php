<?php

namespace Swf;

class WorkflowEvents {

	private $events;

	private static $eventClasses = [
		'WorkflowExecutionStarted' => 'Swf\Event\WorkflowStarted',
		'WorkflowExecutionCompleted' => 'Swf\Event\WorkflowCompleted',
		'WorkflowExecutionFailed' => 'Swf\Event\WorkflowFailed',
		'WorkflowExecutionTimedOut' => 'Swf\Event\WorkflowTimedOut',
		'WorkflowExecutionTerminated' => 'Swf\Event\WorkflowTerminated',
		'ActivityTaskScheduled' => 'Swf\Event\ActivityScheduled',
		'ActivityTaskStarted' => 'Swf\Event\ActivityStarted',
		'ActivityTaskCompleted' => 'Swf\Event\ActivityCompleted',
		'ActivityTaskFailed' => 'Swf\Event\ActivityFailed',
		'ActivityTaskTimedOut' => 'Swf\Event\ActivityTimedOut',
	];

	public function __construct(array $eventsJson) {
		$this->events = self::createEvents($eventsJson);
	}

	private static function createEvents(array $events) {
		return array_map([self, 'createEvent'], $events);
	}

	private static function createEvent(array $json) {
		if(array_key_exists($json['eventType'], self::$eventClasses)) {
			$class = self::$eventClasses[$json['eventType']];
			return new $class($json);
		}
		else {
			return new Event\Base($json);
		}
	}

	private function filterEvents(callable $filterFunc) {
		return array_values(array_filter($this->events, $filterFunc));
	}

	private function getFirst(array $options) {
		if(count($options) === 0) {
			throw new Exception\NotFoundException();
		}
		return array_shift($options);
	}

	public function getEventById($eventId) {
		$options = $this->filterEvents(
			function($event) use ($eventId) {
				return $event->getId() == $eventId;
			});
		return $this->getFirst($options);
	}

	private function getAllByType($type) {
		return $this->filterEvents(
			function($event) use ($type) {
				return $event->getType() === $type;
			});
	}

	private function getAllByTypeArray(array $types) {
		return $this->filterEvents(
			function($event) use ($types) {
				return in_array($event->getType(), $types);
			});
	}

	public function getWorkflowStartedEvent() {
		$options = $this->getAllByType('WorkflowExecutionStarted');
		return $this->getFirst($options);
	}

	public function getWorkflowStoppedEvent() {
		$options = $this->getAllByTypeArray([
			'WorkflowExecutionCompleted',
			'WorkflowExecutionFailed',
			'WorkflowExecutionTimedOut',
			'WorkflowExecutionTerminated',
		]);
		return $this->getFirst($options);
	}

	public function getAllActivityStartedEvents() {
		return $this->getAllByType('ActivityTaskStarted');
	}

	public function getAllActivityStoppedEvents() {
		return $this->getAllByTypeArray([
			'ActivityTaskCompleted',
			'ActivityTaskFailed',
			'ActivityTaskTimedOut',
		]);
	}

}

?>
