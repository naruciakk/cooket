<?php

namespace App\Support\Payments;

use Illuminate\Http\Request;

use App\Method;

class Paying {

	public static function show($organization, $guest) {
		$output = "";

		$methods = Method::where('organization', $organization)->get();

		foreach ($methods as $method) {
			if($method->type == 'Przelewy24') {
				$pay = new Przelewy24;
				$pay->setMethod($method);
				$pay->setGuest($guest);
				$output .= $pay->show();
			}
			else if($method->type == 'Transfer') {
				$pay = new Transfer;
				$pay->setMethod($method);
				$pay->setGuest($guest);
				$output .= $pay->show();
			}
		}

		return $output;
	}

}