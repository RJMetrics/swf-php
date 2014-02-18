<?php

namespace Swf\Event;

class ActivityScheduled extends Base {

	private $activityName;

	public function __construct(array $json) {
		parent::__construct($json);
		$attrs = $json['activityTaskScheduledEventAttributes'];
		$this->activityName = $attrs['activityType']['name'];
	}

	public function getActivityName() {
		return $this->activityName;
	}

}

?>
