<?php

namespace App\Support\SignUp;

use Illuminate\Http\Request;

use App\Support\SignUp\Field;

class Helpers extends Form {

	public function __construct() {
		parent::__construct("Helpers");
		$this->addField(new Field("time", 191));
		$this->addField(new Field("experience", 191));
		$this->addField(new Field("phone", 191));
		$this->addField(new Field("information", 2000));
	}

}