<?php

namespace Swf\Event;

class WorkflowStarted extends Base {

	private $workflowName;

	public function __construct(array $json) {
		parent::__construct($json);
		$attrs = self::jsonGet($json, 'workflowExecutionStartedEventAttributes');
		$this->workflowName = self::jsonGet(self::jsonGet($attrs, 'workflowType'), 'name');
	}

	public function getWorkflowName() {
		return $this->workflowName;
	}

}

?>
