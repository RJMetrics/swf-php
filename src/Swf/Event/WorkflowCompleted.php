<?php

namespace Swf\Event;

class WorkflowCompleted extends Base implements StopperEvent {

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
