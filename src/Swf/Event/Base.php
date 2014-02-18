<?php

namespace Swf\Event;

class Base {

	private $id;
	private $type;
	private $timestamp;

	public function __construct(array $json) {
		$this->id = $json['eventId'];
		$this->type = $json['eventType'];
		$this->timestamp = $json['eventTimestamp'];
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

}

?>
