<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;

class HistoryController extends Controller
{
    public function index() {
    	$events = Event::orderBy('created_at', 'desc')->get();
        return view('history')
        	->with('events', $events);
    }
}
