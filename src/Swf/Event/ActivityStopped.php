<?php

namespace Swf\Event;

abstract class ActivityStopped extends Base {

	abstract public function getScheduledEventId();
	abstract public function getStartedEventId();
	abstract public function wasSuccessful();
	abstract public function getErrorMessage();

}

?>
