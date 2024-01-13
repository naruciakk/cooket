<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\GiveTickets;
use Illuminate\Support\Facades\Mail;

use App\Guest;
use App\TicketPayment;
use App\Ticket;
use App\Payment;
use App\Event;
use App\Organization;
use App\GuestData;
use App\OnlineGuest;

use App\Mail\GuestRegistered;
use App\Mail\PaymentInformation;

use Auth;
use DateTime;

class GuestSaveController extends Controller
{
    public function __construct() {
        $this->middleware('tenant');
    }

    public function index(Request $request, $slug) {
        $validate = array('given_name' => 'required|min:2|max:191',
            'family_name' => 'required|min:2|max:191',
            'nickname' => 'max:191',
            'city' => 'required|min:2|max:191',
            'ticket' => 'required',
            'annotation' => 'max:1000',
			'userimage' => 'file|image|mimes:jpeg,png|max:2048',
			'consent' => 'required',
		);

        if(!Auth::check()) $validate['email'] = 'required|email';

        $this->validate($request, $validate);

        $event = Event::where('slug', $slug)->first();

        $id = 0;
        if(Auth::check()) $id = Auth::id();

        $tickets = Ticket::where('event', $event->id)
                ->where('available', 1)
                ->where('amount', '>', 0)
                ->where('start', '<=', new DateTime('today'))
                ->where('finish', '>=', new DateTime('today'))
                ->count();

        if($tickets > 0) {
            $org = Organization::where('id', $event->organization)->first();

            $duplicates = GiveTickets::getDuplicates(
                $id,
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

            if($duplicates) return redirect('/'.$slug);

            $pin = GiveTickets::generatePin();

            $data = new GuestData;
            $guest = new Guest;
            $online = new OnlineGuest;
            $guest->user = $id;
            $guest->event = $event->id;
            $data->given_name = $request->given_name;
            $data->family_name = $request->family_name;
            $data->nickname = $request->nickname;
            $data->city = $request->city;

            if(Auth::check()) $online->email = Auth::user()->email;
            else $online->email = $request->email;

			$userimage = $request->file('userimage');
			$theCode = GiveTickets::generateCode($slug);

            if(isset($request->accomodation))
                $guest->accomodation = $request->accomodation;
			if(isset($userimage)) {
				$uipath = $userimage->storeAs($event->slug, $theCode.'.'.$userimage->extension());
				$online->userimage = $uipath;
			}
            $guest->adult = $request->adult;
            $guest->ticket = $request->ticket;
            $guest->code = $theCode;
            $guest->annotation = $request->annotation;
            $online->is_main = 0;
            $online->sha = sha1($event->id.'-'.$guest->code);
            $online->pin = password_hash($pin, PASSWORD_BCRYPT);
            $guest->save();
            $online->guest = $guest->id;
            $online->save();
            $data->guest = $guest->id;
            $data->save();

            $payments = TicketPayment::where('ticket', $guest->ticket)->get();
            $ticket = Ticket::where('id', $guest->ticket)->first();
            $ticket->amount -= 1;
            $ticket->save();

            Mail::to($online->email)->send(new GuestRegistered($event, $pin, $online->sha));

            foreach ($payments as $payment) {
            	$ticket = new Payment;
            	$ticket->event = $event->id;
            	$ticket->guest = $guest->id;
            	$ticket->amount = $payment->amount;
            	$ticket->description = $payment->description;
            	$ticket->paid = 0;
            	$ticket->save();
            }
        }
        return redirect('/'.$slug.'/'.$online->sha);
    }

    public function registered(Request $request, $slug) {
        $this->validate($request, [
            'ticket' => 'required',
            'annotation' => 'max:1000',
			'userimage' => 'file|image|mimes:jpeg,png|max:2048',
			'consent' => 'required',
        ]);

        $event = Event::where('slug', $slug)->first();

        $tickets = Ticket::where('event', $event->id)
                ->where('available', 1)
                ->where('amount', '>', 0)
                ->where('start', '<=', new DateTime('today'))
                ->where('finish', '>=', new DateTime('today'))
                ->count();

        if($tickets > 0) {
            $org = Organization::where('id', $event->organization)->first();
            $user = Auth::user();

            $duplicates = GiveTickets::getDuplicates(
                $user->id,
                $event->id,
                $user->given_name,
                $request->family_name,
                $request->nickname,
                $request->city,
                $request->email,
                $request->accomodation,
                $request->adult,
                $request->ticket,
                $request->annotation
            );

            if($duplicates) return redirect('/'.$event->slug);

            $pin = GiveTickets::generatePin();

			$userimage = $request->file('userimage');
			$theCode = GiveTickets::generateCode($slug);

            $data = new GuestData;
            $guest = new Guest;
            $online = new OnlineGuest;
            $guest->user = $user->id;
            $guest->event = $event->id;
            $data->given_name = $user->given_name;
            $data->family_name = $user->family_name;
            $data->nickname = $user->nickname;
            $data->city = $user->city;
            $online->email = $user->email;
            if(isset($request->accomodation))
                $guest->accomodation = $request->accomodation;
            else
                $guest->accomodation = 0;
			if(isset($userimage)) {
				$uipath = $userimage->storeAs($event->slug, $theCode.'.'.$userimage->extension());
				$online->userimage = $uipath;
			}
            $guest->adult = $request->adult;
            $guest->ticket = $request->ticket;
            $guest->code = $theCode;
            $guest->annotation = $request->annotation;
            $online->pin = password_hash($pin, PASSWORD_BCRYPT);
            $online->sha = sha1($event->id.'-'.$guest->code);
            $online->is_main = 1;
            $guest->save();
            $online->guest = $guest->id;
            $online->save();
            $data->guest = $guest->id;
            $data->save();

            $payments = TicketPayment::where('ticket', $guest->ticket)->get();
            $ticket = Ticket::where('id', $guest->ticket)->first();
            $ticket->amount -= 1;
            $ticket->save();

            if (env("APP_DEPLOYMENT", "local") == "global") {
                Mail::to($online->email)->send(new GuestRegistered($event, $pin, $online->sha));
            }

            foreach ($payments as $payment) {
            	$ticket = new Payment;
            	$ticket->event = $event->id;
            	$ticket->guest = $guest->id;
            	$ticket->amount = $payment->amount;
            	$ticket->description = $payment->description;
            	$ticket->paid = 0;
            	$ticket->save();
            }

            return redirect('/'.$slug.'/'.$online->sha);
        }
    }
}
