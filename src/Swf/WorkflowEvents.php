<?php

namespace Swf;

class WorkflowEvents {

	private $events;

	public function __construct(array $eventsJson) {
		$this->events = self::createEvents($eventsJson);
	}

	private static function createEvents(array $events) {
		return array_map([self, 'createEvent'], $events);
	}

	private static function createEvent(array $json) {
		switch($json['eventType']) {
			case 'WorkflowExecutionStarted':
				return new Event\WorkflowStarted($json);
			case 'WorkflowExecutionCompleted':
				return new Event\WorkflowCompleted($json);
			case 'ActivityTaskScheduled':
				return new Event\ActivityScheduled($json);
			case 'ActivityTaskStarted':
				return new Event\ActivityStarted($json);
			case 'ActivityTaskCompleted':
				return new Event\ActivityCompleted($json);
			case 'ActivityTaskFailed':
				return new Event\ActivityFailed($json);
			default:
				return new Event\Base($json);
		}
	}

	private function filterEvents(callable $filterFunc) {
		return array_values(array_filter($this->events, $filterFunc));
	}

	private function getFirst(array $options) {
		if(count($options) === 0) {
			throw new NotFoundException();
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

	public function getWorkflowStartedEvent() {
		$options = $this->getAllByType('WorkflowExecutionStarted');
		return $this->getFirst($options);
	}

	public function getWorkflowCompletedEvent() {
		$options = $this->getAllByType('WorkflowExecutionCompleted');
		return $this->getFirst($options);
	}

	public function getAllActivityStartedEvents() {
		return $this->getAllByType('ActivityTaskStarted');
	}

	public function getAllActivityCompletedEvents() {
		return $this->getAllByType('ActivityTaskCompleted');
	}

}

?>
