<?php

namespace Swf\Event;

class WorkflowStarted extends Base {

	private $workflowName;

	public function __construct(array $json) {
		parent::__construct($json);
		$attrs = $json['workflowExecutionStartedEventAttributes'];
		$this->workflowName = $attrs['workflowType']['name'];
	}

	public function getWorkflowName() {
		return $this->workflowName;
	}

}

?>
