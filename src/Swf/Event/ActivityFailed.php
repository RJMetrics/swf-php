<?php

namespace Swf\Event;

class ActivityFailed extends ActivityStopped {

	private $scheduledEventId;
	private $startedEventId;
	private $reason;

	public function __construct(array $json) {
		parent::__construct($json);
		$attrs = self::jsonGet($json, 'activityTaskFailedEventAttributes');
		$this->scheduledEventId = self::jsonGet($attrs, 'scheduledEventId');
		$this->startedEventId = self::jsonGet($attrs, 'startedEventId');
		$this->reason = self::jsonGetOrDefault($attrs, 'reason', null);
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
