<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\Organization;
use App\Guest;
use App\OnlineGuest;
use App\Ticket;

use Auth;
use DateTime;

class PageController extends Controller
{
    public function __construct() {
        $this->middleware('tenant');
    }

    public function index($slug) {
    	$event = Event::where('slug', $slug);

    	if($event->count()) {
    		$event = $event->first();
    		$org = Organization::findOrFail($event->organization);
            $tickets = Ticket::where('event', $event->id)
                ->where('available', 1)
                ->where('amount', '>', 0)
                ->where('start', '<=', new DateTime('today'))
                ->where('finish', '>=', new DateTime('today'))
                ->count();
    		if(Auth::check()) {
    			$bought = 0;
                $user = Auth::user();
    			$guests = Guest::where('user', $user->id)->where('event', $event->id);
                if($guests->count()) {
                    foreach ($guests->get() as $guest) {
                        $bought += OnlineGuest::where('guest', $guest->id)->where('is_main', 1)->count();
                    }
                }
    		}
    		else $bought = 0;

    		return view('signing.page')
    				->with('event', $event)
                    ->with('tickets', $tickets)
    				->with('org', $org)
    				->with('bought', $bought);
    	}
    	else return redirect('/');
    }

    public function success() {
        return view('welcome');
    }
}
