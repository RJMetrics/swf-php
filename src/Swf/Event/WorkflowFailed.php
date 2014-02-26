<?php

namespace Swf\Event;

class WorkflowFailed extends WorkflowStopped {

	private $reason;
	private $details;

	public function __construct(array $json) {
		parent::__construct($json);
		$attrs = self::jsonGet($json, 'workflowExecutionFailedEventAttributes');
		$this->reason = self::jsonGetOrDefault($attrs, 'reason', null);
		$this->details = self::jsonGetOrDefault($attrs, 'details', null);
	}

	public function wasSuccessful() {
		return false;
	}

	public function getErrorMessage() {
		return $this->reason;
	}

	public function getErrorDetails() {
		return $this->details;
	}

}

?>
