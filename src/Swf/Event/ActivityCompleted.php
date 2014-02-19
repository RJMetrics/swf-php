<?php

namespace Swf\Event;

class ActivityCompleted extends ActivityStopped {

	private $scheduledEventId;
	private $startedEventId;

	public function __construct(array $json) {
		parent::__construct($json);
		$attrs = self::jsonGet($json, 'activityTaskCompletedEventAttributes');
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
		return true;
	}

	public function getErrorMessage() {
		return null;
	}

}

?>
