<?php

namespace App\Support\SignUp;

use Illuminate\Http\Request;

use App\Support\SignUp\Field;

class Form {

	protected $name;
	protected $fields;

	public function __construct($name) {
		$this->name = $name;
		$this->fields = array();
	}

	public function getName() {
		return $this->name;
	}

	public function getFields() {
		return $this->fields;
	}

	public function addField(Field $field) {
		$i = count($this->fields);
		$this->fields[$i] = $field;
	}

}