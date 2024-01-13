<?php

namespace App\Http\Controllers\Org;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Support\GiveTickets;
use Illuminate\Support\Facades\DB;

use App\Guest;
use App\GuestData;
use App\TicketPayment;
use App\Ticket;
use App\Payment;
use App\Event;
use App\Organization;
use App\GuestPayment;
use App\GuestPaymentType;

use Auth;

class SigningController extends Controller
{
    public function __construct() {
        $this->middleware('tenant');
		$this->middleware('perm:signing,org');
	}

	public function index() {
		$user = Auth::user();
        $event = Event::findOrFail($user->active_event);
        $guests = DB::connection('tenant')
                ->table('guests')
                ->join('guest_data', 'guest_data.guest', '=', 'guests.id')
                ->select('guests.id', 'guests.code', 'guest_data.given_name', 'guest_data.family_name', 'guest_data.nickname', 'guest_data.city')
                ->where('guests.event', $user->active_event)
                ->where('sign', NULL)
                ->get();

        return view('org.signing.list')
            ->with('guests', $guests)
            ->with('event', $event);
    }

    public function show($id) {
    	$user = Auth::user();
    	$guest = Guest::findOrFail($id);
        $data = GuestData::where('guest', $guest->id)->first();
        $event = Event::findOrFail($user->active_event);
    	$ticket = Ticket::findOrFail($guest->ticket);
    	$payments = Payment::where('guest', $guest->id)->get();
        $paymentTypes = GuestPaymentType::where('event', $event->id)->get();

    	if($user->active_event == $guest->event && $guest->sign == NULL)
    		return view('org.signing.show')
    			->with('guest', $guest)
                ->with('data', $data)
    			->with('ticket', $ticket)
                ->with('event', $event)
                ->with('paymentTypes', $paymentTypes)
    			->with('payments', $payments);
    	else
    		return redirect('/signing');
    }

    public function sign(Request $request, $id) {
    	$this->validate($request, [
            'sign' => 'required',
            'sign_annotation' => 'max:1000',
            'payment_information' => 'max:191',
        ]);

        $paid = $request->paid;

        $guest = Guest::findOrFail($id);
        $payments = Payment::where('guest', $guest->id)->get();

        $guest->sign = $request->sign;
        $guest->sign_annotation = $request->sign_annotation;
        $guest->save();
        $guestPayment = new GuestPayment;
        $guestPayment->guest = $guest->id;
        $guestPayment->type = $request->payment_type;
        $guestPayment->description = $request->payment_information;
        $guestPayment->save();

        if($paid != NULL) {
	        foreach ($payments as $payment) {
	        	if(in_array($payment->id, $paid)) {
	        		$payment->paid = Auth::user()->id;
	        		$payment->save();
	        	}
	        }
	    }

        return redirect('/signing');
    }

	public function add() {
		$user = Auth::user();
		$event = Event::findOrFail($user->active_event);
        $paymentTypes = GuestPaymentType::where('event', $event->id)->get();

		return view('org.signing.add')
            ->with('paymentTypes', $paymentTypes)
			->with('event', $event);
    }

    public function insert(Request $request) {
        $this->validate($request, [
            'given_name' => 'required|min:2|max:255',
            'family_name' => 'required|min:2|max:255',
            'nickname' => 'max:255',
            'city' => 'required|min:2|max:255',
            'ticket' => 'required',
            'annotation' => 'max:1000',
            'sign' => 'required',
            'payment_information' => 'max:191',
        ]);

        $user = Auth::user();
        $event = Event::findOrFail($user->active_event);
        $org = Organization::where('id', $event->organization)->first();

        $guest = new Guest;
        $data = new GuestData;
        $guest->user = 0;
        $guest->event = $event->id;
        $data->given_name = $request->given_name;
        $data->family_name = $request->family_name;
        $data->nickname = $request->nickname;
        if($request->nickname == NULL) $data->nickname = "brak";
        $data->city = $request->city;
        $guest->sign = $request->sign;
        $guest->accomodation = $request->accomodation;
        if($request->accomodation == NULL) $guest->accomodation = 0;
        $guest->adult = $request->adult;
        $guest->ticket = $request->ticket;
        $guest->code = GiveTickets::generateCode($event->slug);
        $guest->sign_annotation = $request->sign_annotation;
        $guest->save();
        $data->guest = $guest->id;
        $data->save();

        $guestPayment = new GuestPayment;
        $guestPayment->guest = $guest->id;
        $guestPayment->type = $request->payment_type;
        $guestPayment->description = $request->payment_information;
        $guestPayment->save();

        $payments = TicketPayment::where('ticket', $guest->ticket)->get();
        $ticket = Ticket::where('id', $guest->ticket)->first();
        $ticket->amount -= 1;
        $ticket->save();

        foreach ($payments as $payment) {
            $ticket = new Payment;
            $ticket->event = $event->id;
            $ticket->guest = $guest->id;
            $ticket->amount = $payment->amount;
            $ticket->description = $payment->description;
            $ticket->paid = Auth::user()->id;
            $ticket->save();
        }

        return redirect('/signing');
    }
}
