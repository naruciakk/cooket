<?php

namespace App\Http\Controllers\Org;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\TicketPayment;
use App\Ticket;

use Auth;

class TicketPaymentController extends Controller
{
    public function __construct() {
        $this->middleware('tenant');
        $this->middleware('perm:ticket,org');
    }
    
    public function edit($id) {
    	$user = Auth::user();
    	$payment = TicketPayment::findOrFail($id);

    	if($user->active_event == $payment->event) {
    		return view('org.ticket.payment')
    			->with('payment', $payment);
    	}
    	else
    		return redirect('/events');
    }

    public function save(Request $request, $id) {
    	$this->validate($request, [
            'description' => 'required|min:6|max:255',
            'amount' => 'required|integer',
        ]);
    	$user = Auth::user();
    	$payment = TicketPayment::findOrFail($id);

    	if($user->active_event == $payment->event) {
    		$payment->description = $request->description;
    		$payment->amount = $request->amount;

    		$payment->save();

    		return redirect('/tickets/'.$payment->event);
    	}
    	else
    		return redirect('/tickets');
    }

    public function add(Request $request, $id) {
    	$this->validate($request, [
            'description' => 'required|min:6|max:255',
            'amount' => 'required|integer',
        ]);
    	$user = Auth::user();
    	$payment = new TicketPayment;

    	$payment->event = $user->active_event;
    	$payment->ticket = $id;
    	$payment->description = $request->description;
    	$payment->amount = $request->amount;

    	$payment->save();

    	return redirect('/tickets/'.$id);
    }

    public function delete($id) {
    	$user = Auth::user();
    	$payment = TicketPayment::findOrFail($id);

    	if($user->active_event == $payment->event) {
    		$id = $payment->ticket;
    		$payment->delete();

    		return redirect('/tickets/'.$id);

    	}
    	else
    		return redirect('/tickets');
    }
}
