<?php

namespace Swf\Event;

class ActivityTimedOut extends ActivityStopped {

	private $scheduledEventId;
	private $startedEventId;

	public function __construct(array $json) {
		parent::__construct($json);
		$attrs = self::jsonGet($json, 'activityTaskTimedOutEventAttributes');
		$this->scheduledEventId = self::jsonGet($attrs, 'scheduledEventId');
		$this->startedEventId = self::jsonGet($attrs, 'startedEventId');
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
