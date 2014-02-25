<?php

namespace Swf\Event;

class WorkflowCompleted extends WorkflowStopped {

	private $result;

	public function __construct(array $json) {
		parent::__construct($json);
		$attrs = self::jsonGet($json, 'workflowExecutionCompletedEventAttributes');
		$this->result = self::jsonGet($attrs, 'result');
	}

	public function wasSuccessful() {
		return true;
	}

	public function getErrorMessage() {
		return null;
	}

	public function getErrorDetails() {
		return null;
	}

	public function getResult() {
		return $this->result;
	}

}

?>
