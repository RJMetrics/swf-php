<?php

namespace Swf\Event;

class WorkflowFailed extends WorkflowStopped {

	private $reason;
	private $details;

	public function __construct(array $json) {
		parent::__construct($json);
		$attrs = self::jsonGet($json, 'workflowExecutionFailedEventAttributes');
		$this->reason = self::jsonGet($attrs, 'reason');
		$this->details = self::jsonGet($attrs, 'details');
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
