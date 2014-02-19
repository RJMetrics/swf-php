<?php

namespace Swf\Event;

class ActivityFailed extends Base implements StopperEvent {

	private $scheduledEventId;
	private $startedEventId;
	private $reason;

	public function __construct(array $json) {
		parent::__construct($json);
		$attrs = $json['activityTaskFailedEventAttributes'];
		$this->scheduledEventId = $attrs['scheduledEventId'];
		$this->startedEventId = $attrs['startedEventId'];
		$this->reason = $attrs['reason'];
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
		return $this->reason;
	}

}

?>
