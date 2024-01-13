<?php

namespace App\Http\Controllers\Org;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Ticket;
use App\TicketPayment;
use App\Guest;

use Auth;

class TicketController extends Controller
{
    public function __construct() {
        $this->middleware('tenant');
		$this->middleware('perm:ticket,org');
	}

    public function index() {
    	$user = Auth::user();
    	$tickets = Ticket::where('event', $user->active_event)->get();

        return view('org.ticket.list', compact('tickets', $tickets));
    }

    public function edit($id) {
        $ticket = Ticket::findOrFail($id);
        $guests = Guest::where('ticket', $id)->count();
        $payments = TicketPayment::where('ticket', $id)->get();

        return view('org.ticket.edit')
            ->with('ticket', $ticket)
            ->with('guests', $guests)
            ->with('payments', $payments);
    }

    public function save(Request $request, $id) {
    	$this->validate($request, [
            'name' => 'required|min:6|max:255',
            'start' => 'required',
            'finish' => 'required',
            'color' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'available' => 'required|max:191',
        ]);
    	$user = Auth::user();
    	$ticket = Ticket::findOrFail($id);

    	if($user->active_event == $ticket->event) {
    		$ticket->name = $request->name;
    		$ticket->start = $request->start;
    		$ticket->finish = $request->finish;
    		$ticket->amount = $request->amount;
    		$ticket->description = $request->description;
    		$ticket->color = $request->color;
    		$ticket->available = $request->available;

    		$ticket->save();
    	}

    	return redirect('/tickets');
    }

    public function newf() {
		return view('org.ticket.add');
    }

    public function add(Request $request) {
    	$this->validate($request, [
            'name' => 'required|min:6|max:255',
            'start' => 'required',
            'finish' => 'required',
            'color' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'available' => 'required',
        ]);
    	$user = Auth::user();
    	$ticket = new Ticket;

    	$ticket->event = $user->active_event;
    	$ticket->name = $request->name;
    	$ticket->description = $request->description;
    	$ticket->color = $request->color;
    	$ticket->start = $request->start;
    	$ticket->finish = $request->finish;
    	$ticket->amount = $request->amount;
    	$ticket->available = $request->available;

    	$ticket->save();

    	return redirect('/tickets');
    }

    public function delete($id) {
    	$user = Auth::user();
    	$ticket = Ticket::findOrFail($id);
    	$guests = Guest::where('ticket', $id)->count();

    	if($user->active_event == $ticket->event) {
			if($guests == 0) {
				$ticket->delete();
			}
    	}

    	return redirect('/tickets');
    }
}
