<?php

namespace App\Support\Payments;

use Illuminate\Http\Request;

use App\Organization;
use App\Method;
use App\Guest;

class Przelewy24 implements Payment {

	private $method;
	private $guest;

	public function setMethod(Method $method) {
		$this->method = $method;
	}

	public function setGuest(Guest $guest) {
		$this->guest = $guest;
	}

	public function show() {
		$payments = \App\Payment::where('guest', $this->guest->id)->get();
		$price = 0;

		foreach($payments as $payment)
			$price += $payment->amount;

		$price *= 100;

		return ''; // This has not been implemented after all
	}

}