<?php

namespace App\Http\Controllers\Org;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Support\GiveTickets;
use Illuminate\Support\Facades\Mail;
use League\Csv\Writer;
use SplTempFileObject;

use App\Guest;
use App\TicketPayment;
use App\Ticket;
use App\Payment;
use App\Event;
use App\Organization;
use App\GuestData;
use App\OnlineGuest;

use App\Mail\GuestRegistered;

use Auth;
use Hash;
use DB;

class GuestController extends Controller
{
	public function __construct() {
		$this->middleware('tenant');
		$this->middleware('perm:guests,org');
	}

    public function index() {
    	$user = Auth::user();
        $event = Event::findOrFail($user->active_event);
        $guests = DB::connection('tenant')
                ->table('guests')
                ->join('guest_data', 'guest_data.guest', '=', 'guests.id')
                ->select('guests.id', 'guests.code', 'guests.user', 'guests.adult', 'guests.accomodation', 'guest_data.given_name', 'guest_data.family_name', 'guest_data.nickname', 'guest_data.city')
                ->where('guests.event', $user->active_event)
                ->get();

        return view('org.guest.list')
            ->with('guests', $guests)
            ->with('event', $event);
    }

    public function print() {
        $user = Auth::user();
        $guests = Guest::where('event', $user->active_event)->get();

        return view('org.guest.print', compact('guests', $guests));
    }

    public function insert(Request $request) {
        $this->validate($request, [
            'given_name' => 'required|min:2|max:255',
            'family_name' => 'required|min:2|max:255',
            'nickname' => 'max:255',
            'city' => 'required|min:5|max:255',
            'email' => 'required|email',
            'ticket' => 'required',
            'annotation' => 'max:1000',
        ]);

        $user = Auth::user();
        $event = Event::findOrFail($user->active_event);
        $org = Organization::where('id', $event->organization)->first();

        $duplicates = GiveTickets::getDuplicates(
            0,
            $event->id,
            $request->given_name,
            $request->family_name,
            $request->nickname,
            $request->city,
            $request->email,
            $request->accomodation,
            $request->adult,
            $request->ticket,
            $request->annotation
        );

        if($duplicates) return redirect('/guests');

        $pin = GiveTickets::generatePin();

        $data = new GuestData;
        $online = new OnlineGuest;
        $guest = new Guest;
        $guest->user = 0;
        $guest->event = $event->id;
        $data->given_name = $request->given_name;
        $data->family_name = $request->family_name;
        $data->nickname = $request->nickname;
        $data->city = $request->city;
        $online->email = $request->email;
        $guest->accomodation = $request->accomodation;
        if($request->accomodation == NULL) $guest->accomodation = 0;
        $guest->adult = $request->adult;
        $guest->ticket = $request->ticket;
        $guest->code = GiveTickets::generateCode($event->slug);
        $guest->annotation = $request->annotation;
        $online->is_main = 0;
        $online->pin = password_hash($pin, PASSWORD_BCRYPT);
        $online->sha = sha1($event->id.'-'.$guest->code);
        $guest->save();
        $online->guest = $guest->id;
        $online->save();
        $data->guest = $guest->id;
        $data->save();

        Mail::to($online->email)->send(new GuestRegistered($event, $pin, $online->sha));

        $payments = TicketPayment::where('ticket', $guest->ticket)->get();
        $ticket = Ticket::where('id', $guest->ticket)->first();
        $ticket->amount -= 1;
        $ticket->save();

        return redirect('/guests');
    }

    public function show($id) {
    	$user = Auth::user();
        //$thehighest = Guest::orderBy('id', 'desc')->first();
        //if($id > $thehighest->id) return redirect('/');
    	$guest = Guest::findOrFail($id);
        //if($guest == NULL) return redirect('/guests/'.($id+1));
        $data = GuestData::where('guest', $id)->first();
        $event = Event::findOrFail($user->active_event);
    	$ticket = Ticket::findOrFail($guest->ticket);
    	$payments = Payment::where('guest', $guest->id)->get();
        $online = OnlineGuest::where('guest', $guest->id)->first();

    	if($user->active_event == $guest->event)
    		return view('org.guest.show')
                ->with('guest', $guest)
                ->with('online', $online)
                ->with('data', $data)
    			->with('ticket', $ticket)
                ->with('event', $event)
    			->with('payments', $payments);
    	else
    		return redirect('/guests');
    }

    public function save(Request $request, $id) {
    	$this->validate($request, [
            'given_name' => 'required|min:2|max:255',
            'family_name' => 'required|min:2|max:255',
            'nickname' => 'min:2|max:50',
            'email' => 'required|email|max:255',
            'city' => 'required|max:50',
            'annotation' => 'required|max:1000',
        ]);
    	$user = Auth::user();
    	$guest = Guest::findOrFail($id);
        $data = GuestData::where('guest', $id)->first();
        $online = OnlineGuest::where('guest', $id)->first();

    	if($user->active_event == $guest->event) {
    		$data->given_name = $request->given_name;
            $data->family_name = $request->family_name;
    		$data->nickname = $request->nickname;
    		$online->email = $request->email;
    		$data->city = $request->city;
    		$guest->annotation = $request->annotation;

    		$guest->save();
            $data->save();
            $online->save();

    		return redirect('/guests/'.$guest->id);
    	}
    	else
    		return redirect('/guests');
    }

    public function change($id) {
    	$user = Auth::user();
    	$payment = Payment::findOrFail($id);

    	if($user->active_event == $payment->event) {
    		if($payment->paid)
    			$payment->paid = 0;
    		else
    			$payment->paid = 1;

    		$payment->save();

    		return redirect('/guests/'.$payment->guest);
    	}
    	else
    		return redirect('/guests');
    }

    public function editPayment($id) {
    	$user = Auth::user();
    	$payment = Payment::findOrFail($id);

    	if($user->active_event == $payment->event) {
    		return view('org.guest.payment')
    			->with('payment', $payment);
    	}
    	else
    		return redirect('/guests');
    }

    public function savePayment(Request $request, $id) {
    	$this->validate($request, [
            'description' => 'required|min:6|max:255',
            'amount' => 'required|integer',
        ]);
    	$user = Auth::user();
    	$payment = Payment::findOrFail($id);

    	if($user->active_event == $payment->event) {
    		$payment->description = $request->description;
    		$payment->amount = $request->amount;

    		$payment->save();

    		return redirect('/guests/'.$payment->guest);
    	}
    	else
    		return redirect('/guests');
    }

    public function addPayment(Request $request, $id) {
    	$this->validate($request, [
            'description' => 'required|min:6|max:255',
            'amount' => 'required|integer',
        ]);
    	$user = Auth::user();
    	$payment = new Payment;

    	$payment->event = $user->active_event;
    	$payment->guest = $id;
    	$payment->description = $request->description;
    	$payment->amount = $request->amount;
    	$payment->paid = 0;

    	$payment->save();

    	return redirect('/guests/'.$id);
    }

    public function deletePayment($id) {
    	$user = Auth::user();
    	$payment = Payment::findOrFail($id);

    	if($user->active_event == $payment->event) {
    		$id = $payment->guest;
    		$payment->delete();

    		return redirect('/guests/'.$id);

    	}
    	else
    		return redirect('/guests');
    }

    public function delete($id) {
    	$user = Auth::user();
    	$guest = Guest::findOrFail($id);

    	if($user->active_event == $guest->event) {
    		return view('org.guest.delete')
    			->with('guest', $guest);
    	}
    	else
    		return redirect('/guests');
    }

    public function remove(Request $request, $id) {
    	$user = Auth::user();
    	$guest = Guest::findOrFail($id);
        $data = GuestData::where('guest', $id)->first();
        $online = OnlineGuest::where('guest', $id)->first();

    	if($user->active_event == $guest->event) {
			if(Hash::check($request->password, $user->password)) {
				$payments = Payment::where('guest', $guest->id)->get();
                foreach ($payments as $payment) {
                    $payment->delete();
                }

                if($guest != NULL) $guest->delete();
                if($data != NULL) $data->delete();
                if($online != NULL) $online->delete();
			}
    	}

    	return redirect('/guests');
    }

    public function printing() {
        $user = Auth::user();
        $first = Guest::where('event', $user->active_event)->orderBy('id', 'ASC')->first();
        $guests = Guest::where('event', $user->active_event)->get();
        $datas = GuestData::all();

        return view('org.guest.print')
                ->with('first', $first)
                ->with('datas', $datas)
                ->with('guests', $guests);
    }

    public function generateCSV() {
        $user = Auth::user();
        $information = DB::connection('tenant')->table('guests')
                        ->where('guests.event', $user->active_event)
                        ->join('tickets', 'guests.ticket', '=', 'tickets.id')
                        ->join('online_guests', 'online_guests.guest', '=', 'guests.id')
						->join('guest_data', 'guest_data.guest', '=', 'guests.id')
						->leftJoin('payments', function ($join) {
								$join->on('payments.guest', '=', 'guests.id')
								->where([ ['payments.paid', '=', '0'], ['payments.amount', '>', '0']]);
						})
						->select('guests.code', 'guest_data.nickname', 'guest_data.given_name', 'guest_data.family_name', 'guest_data.city', 'guests.accomodation', 'guests.adult', 'tickets.name', 'online_guests.userimage', 'guests.annotation', DB::raw('COUNT(payments.id) as unpaid'))
						->groupBy('guests.code', 'guest_data.nickname', 'guest_data.given_name', 'guest_data.family_name', 'guest_data.city', 'guests.accomodation', 'guests.adult', 'tickets.name', 'online_guests.userimage', 'guests.annotation')
                        ->get();

        $array = json_decode(json_encode($information), true);

        $csv = Writer::createFromFileObject(new SplTempFileObject());
        $csv->insertOne(['code', 'nickname', 'givenname', 'familyname', 'city', 'accomodation', 'adult', 'ticket', 'image']);
        $csv->insertAll($array);
        $csv->output('guests.csv');
    }
}
