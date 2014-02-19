<?php

namespace Swf\Event;

class ActivityStarted extends Base {

	private $scheduledEventId;

	public function __construct(array $json) {
		parent::__construct($json);
		$attrs = self::jsonGet($json, 'activityTaskStartedEventAttributes');
		$this->scheduledEventId = self::jsonGet($attrs, 'scheduledEventId');
	}

	public function getScheduledEventId() {
		return $this->scheduledEventId;
	}

}

?>
