<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Guest;
use App\Event;
use App\Organization;

use Auth;

class TicketController extends Controller
{
    public function index() {
        $events = Event::orderBy('created_at', 'desc')->get();
        $orgs = Organization::all();
        return view('tickets')
        	->with('orgs', $orgs)
            ->with('events', $events);
    }

    public function home() {
        if(Auth::check()) return redirect('/home');
        $events = Event::where('finish', '>', date('Y-m-d H:i:s'))->get();
    	return view('welcome')
            ->with('events', $events);
    }

    public function terms() {
        return view('terms');
    }
}
