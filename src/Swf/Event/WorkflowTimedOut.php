<?php

namespace Swf\Event;

class WorkflowTimedOut extends WorkflowStopped {

	public function __construct(array $json) {
		parent::__construct($json);
	}

	public function wasSuccessful() {
		return false;
	}

	public function getErrorMessage() {
		return 'Timeout';
	}

}

?>
