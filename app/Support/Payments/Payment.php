<?php

namespace App\Support\Payments;

use Illuminate\Http\Request;

use App\Method;
use App\Guest;

interface Payment {
	public function show();
	public function setMethod(Method $method);
	public function setGuest(Guest $guest);
}