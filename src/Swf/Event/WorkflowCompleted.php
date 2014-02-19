<?php

namespace Swf\Event;

class WorkflowCompleted extends WorkflowStopped {

	public function __construct(array $json) {
		parent::__construct($json);
	}

	public function wasSuccessful() {
		return true;
	}

	public function getErrorMessage() {
		return null;
	}

}

?>
