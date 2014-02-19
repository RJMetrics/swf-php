<?php

namespace Swf\Event;

class Base {

	private $id;
	private $type;
	private $timestamp;

	public function __construct(array $json) {
		$this->id = self::jsonGet($json, 'eventId');
		$this->type = self::jsonGet($json, 'eventType');
		$this->timestamp = self::jsonGet($json, 'eventTimestamp');
	}

	public function getId() {
		return $this->id;
	}

	public function getType() {
		return $this->type;
	}

	public function getTimestamp() {
		return $this->timestamp;
	}

	public function getDateString() {
		return date('Y-m-d H:i:s', $this->getTimestamp());
	}

	protected static function jsonGet($json, $key) {
		if(isset($json[$key])) {
			return $json[$key];
		}
		throw new \Swf\Exception\MalformedJsonException(
			"Key $key not found in " . json_encode($json));
	}

}

?>
