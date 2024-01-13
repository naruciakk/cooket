<?php

namespace App\Http\Controllers\Org;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Guest;
use App\TicketPayment;
use App\Ticket;
use App\Payment;
use App\Event;
use App\GuestData;
use App\OnlineGuest;

use App\Mail\TransferPaid;

use Auth;

class TransferController extends Controller
{
	public function __construct() {
		$this->middleware('tenant');
		$this->middleware('perm:transfers,org');
	}

    public function index() {
    	$user = Auth::user();
    	$guests = Guest::where('event', $user->active_event)->get();
    	$event = Event::findOrFail($user->active_event);

        $everyone = array();
        $i = 0;

        foreach ($guests as $guest) {
        	$cash = 0;
        	$payments = Payment::where('guest', $guest->id)->get();
        	$data = GuestData::where('guest', $guest->id)->first();
        	foreach ($payments as $payment) 
        		if(!$payment->paid) $cash += $payment->amount;

        	if($cash) {
        		$everyone[$i]['guest'] = $guest;
        		$everyone[$i]['data'] = $data;
        		$everyone[$i++]['cash'] = $cash;
        	}

        }

        return view('org.transfers.list')
        	->with('event', $event)
            ->with('everyone', $everyone);
    }

    public function confirm($id) {
    	$user = Auth::user();
    	$guest = Guest::findOrFail($id);
    	$event = Event::findOrFail($user->active_event);
    	
    	if($guest->event == $user->active_event) {
    		$online = OnlineGuest::where('guest', $guest->id)->first();
    		$payments = Payment::where('guest', $guest->id)->get();

    		foreach($payments as $payment) {
    			$payment->paid = 1;
    			$payment->save();
    		}

    		Mail::to($online->email)->send(new TransferPaid($event));
    	}

    	return redirect('/transfers');
    }
}
