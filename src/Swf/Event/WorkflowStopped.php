<?php

namespace Swf\Event;

abstract class WorkflowStopped extends Base {

	abstract public function wasSuccessful();
	abstract public function getErrorMessage();

}

?>
