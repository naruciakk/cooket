<?php

namespace App\Support\SignUp;

use Illuminate\Http\Request;

class Field {

	protected $name;
	protected $options;
	protected $size;

	public function __construct($name, $size) {
		$this->name = $name;
		$this->size = $size;
		$this->options = array();
	}

	public function addOption($name, $value) {
		$number = count($this->options);
		$this->options[$number]['name'] = $name;
		$this->options[$number]['value'] = $value;
	}

	public function getName() {
		return $this->name;
	}

	public function getSize() {
		return $this->size;
	}

	public function getOptions() {
		if(count($this->options))
			return $this->options;

		return NULL;
	}

}