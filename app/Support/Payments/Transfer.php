<?php

namespace App\Support\Payments;

use Illuminate\Http\Request;

use App\Organization;
use App\Method;
use App\Guest;

class Transfer implements Payment {

	private $method;
	private $guest;

	public function setMethod(Method $method) {
		$this->method = $method;
	}

	public function setGuest(Guest $guest) {
		$this->guest = $guest;
	}

	public function show() {
		$org = Organization::findOrFail($this->method->organization);
		echo '<dl class="dl-horizontal">
                    <dt>Nazwa odbiorcy</dt>
                    <dd>'.$org->name.'</dd>
                    <dt>Adres odbiorcy</dt>
                    <dd>'.$org->address.'</dd>
                    <dt>Numer konta</dt>
                    <dd>'.$org->account_number.'</dd>
                    <dt>Tytuł przelewu</dt>
                    <dd>'.$this->guest->code.'</dd>
             </dl>';
	}

}
