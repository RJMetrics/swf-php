<?php

namespace Swf\Event;

class ActivityScheduled extends Base {

	private $activityName;

	public function __construct(array $json) {
		parent::__construct($json);
		$attrs = self::jsonGet($json, 'activityTaskScheduledEventAttributes');
		$this->activityName = self::jsonGet(self::jsonGet($attrs, 'activityType'), 'name');
	}

	public function getActivityName() {
		return $this->activityName;
	}

}

?>
