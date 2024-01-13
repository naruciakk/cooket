<?php

namespace App\Support;

use Illuminate\Http\Request;

use App\Organization;
use App\Event;
use App\Guest;
use App\Ticket;
use App\TicketPayment;
use App\Payment;
use App\GuestData;
use App\OnlineGuest;
use App\FormType;
use App\Form;
use App\FormField;

use Auth;
use Cookie;

class GiveTickets {

	public static function checkTicket($slug, $sha, $form = 0) {
		$online = OnlineGuest::where('sha', $sha);
        if($online->count() == 0) return 1;
        $online = $online->first();
        $guest = Guest::findOrFail($online->guest);
        $event = Event::findOrFail($guest->event);
        if($slug != $event->slug) return 1;

        if($form != 0) {
        	$formd = Form::findOrFail($form);
        	if($formd->ticket != $guest->id) return 2;
        }

        if($guest->user != 0 && Auth::check()) {
        	$user = Auth::user();
            if($user->id != $guest->user) return 2;
        }
        else {
            if($guest->user != 0)
                return 2;

            if(Cookie::get('pin') == NULL || Cookie::get('sha') == NULL)
                return 3;

            if(Cookie::get('sha') != $online->sha)
                return 3;

            if(Cookie::get('pin') != $online->pin)
                return 3;
        }
	}

	public static function ticketAvaibility($id, $status) {
		$ticket = Ticket::findOrFail($id);
		if(!$status) {
			$available = ($ticket->available) && 
					 ($ticket->start < date('Y-m-d H:i:s')) &&
					 ($ticket->finish > date('Y-m-d H:i:s')) &&
					 ($ticket->amount > 0);
		}
		else {
			$available = ($ticket->available);
		}
		return $available;
	}

	public static function generatePin() {
		$pin = "";
		for($i=0; $i<4; $i++)
			$pin .= rand(0,9);

		return $pin;
	}

	public static function getTickets($id, $status) {
		$tickets = Ticket::where('event', $id)->get();
		$ret = "";

		foreach ($tickets as $ticket) {
			if(GiveTickets::ticketAvaibility($ticket->id, $status)) {
				$payments = TicketPayment::where('ticket', $ticket->id)->get();
				$cost = 0;

				foreach ($payments as $payment) $cost += $payment->amount;

				$ret .= '<li class="list-group-item list-group-item-'.$ticket->color.'"><input type="radio" name="ticket" value="'.$ticket->id.'"> '.$ticket->name.' | '.$cost.' '.env("APP_CURRENCY").' | '.$ticket->description.' <span class="badge badge-secondary">'.$ticket->amount.'</span></li>';
			}
		}

		return $ret;
	}

	public static function generateCode($eventSlug) {
		$event = Event::where('slug', $eventSlug)->first();
		$guests = Guest::where('event', $event->id)->get();
		$kara = 1000000000 / (pow(10, 10-$event->code_length));
		$made = 9999999999 / (pow(10, 10-$event->code_length));
		$code = rand($kara, $made);

		foreach($guests as $guest)
			if($guest->code == $code) 
				$code = GiveTickets::generateCode($eventSlug);

		return $code;
	}

	public static function getDuplicates(
			$user,
			$event,
			$given_name,
			$family_name,
			$nickname,
			$city,
			$email,
			$accomodation,
			$adult,
			$ticketType,
			$annotation
		) {

		$data = GuestData::where('given_name', $given_name)
					->where('family_name', $family_name)
					->where('nickname', $nickname)
					->where('city', $city)
					->count();

		$guest = Guest::where('user', $user)
					->where('event', $event)
					->where('accomodation', $accomodation)
					->where('adult', $adult)
					->where('ticket', $ticketType)
					->where('annotation', $annotation)
					->count();

		return $data*$guest;
	}

}
