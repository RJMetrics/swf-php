<?php

namespace Swf\Event;

/*
 * Classes that implement this interface indicate that the event stops
 * another event. For example, a WorkflowStarted event can be "stopped"
 * by either a WorkflowCompleted event or a WorkflowFailed event.
 */

interface	StopperEvent {

	public function wasSuccessful();
	public function getErrorMessage();

}

?>
