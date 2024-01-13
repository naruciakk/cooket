<?php

namespace App\Support\SignUp;

use Illuminate\Http\Request;

use App\Support\SignUp\Field;

class Merchant extends Form {

	public function __construct() {
		parent::__construct("Merchant");
		$this->addField(new Field("name", 191));
		$this->addField(new Field("description", 1000));
		$this->addField(new Field("merchant", 191));
		$this->addField(new Field("power", 191));
		$this->fields[3]->addOption("Tak", "tak"); 
		$this->fields[3]->addOption("Nie", "nie");
		$this->addField(new Field("tables", 191));
		$this->addField(new Field("information", 2000));
	}

}