<?php

namespace Swf\Event;

class ActivityFailed extends Base {

	private $scheduledEventId;
	private $startedEventId;

	public function __construct(array $json) {
		parent::__construct($json);
		$attrs = $json['activityTaskFailedEventAttributes'];
		$this->scheduledEventId = $attrs['scheduledEventId'];
		$this->startedEventId = $attrs['startedEventId'];
	}

	public function getScheduledEventId() {
		return $this->scheduledEventId;
	}

	public function getStartedEventId() {
		return $this->startedEventId;
	}

}

?>
