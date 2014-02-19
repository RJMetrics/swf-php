<?php

namespace Swf\Event;

class WorkflowFailed extends WorkflowStopped {

	private $reason;

	public function __construct(array $json) {
		parent::__construct($json);
		$attrs = $json['workflowExecutionFailedEventAttributes'];
		$this->reason = $attrs['reason'];
	}

	public function wasSuccessful() {
		return false;
	}

	public function getErrorMessage() {
		return $this->reason;
	}

}

?>
