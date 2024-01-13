<?php

namespace App\Support\SignUp;

use Illuminate\Http\Request;

use App\Support\SignUp\Field;

class Attractions extends Form {

	public function __construct() {
		parent::__construct("Attractions");
		$this->addField(new Field("title", 191));
		$this->addField(new Field("description", 1000));
		$this->addField(new Field("time", 191));
		$this->fields[2]->addOption("1 godzina", "1h"); 
		$this->fields[2]->addOption("2 godziny", "2h");
		$this->fields[2]->addOption("3 godziny", "3h");
		$this->fields[2]->addOption("Ponad 3 godziny", "ponad");
		$this->addField(new Field("creators", 191));
		$this->addField(new Field("equipment", 191));
		$this->addField(new Field("prize", 191));
		$this->addField(new Field("type", 191));
		$this->fields[6]->addOption("Konkurs", "konkurs"); 
		$this->fields[6]->addOption("Prelekcja/panel", "prelekcja");
		$this->fields[6]->addOption("Blok całodzienny", "blok");
		$this->fields[6]->addOption("Inne (opisz w informacjach dodatkowych)", "inne");
		$this->addField(new Field("information", 2000));
	}

}
