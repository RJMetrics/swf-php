<?php

namespace Swf\Event;

class ActivityTimedOut extends Base implements StopperEvent {

	private $scheduledEventId;
	private $startedEventId;

	public function __construct(array $json) {
		parent::__construct($json);
		$attrs = $json['activityTaskTimedOutEventAttributes'];
		$this->scheduledEventId = $attrs['scheduledEventId'];
		$this->startedEventId = $attrs['startedEventId'];
	}

	public function getScheduledEventId() {
		return $this->scheduledEventId;
	}

	public function getStartedEventId() {
		return $this->startedEventId;
	}

	public function wasSuccessful() {
		return false;
	}

	public function getErrorMessage() {
		return 'Timeout';
	}

}

?>
