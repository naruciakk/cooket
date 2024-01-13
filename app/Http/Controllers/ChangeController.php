<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;

use Auth;

class ChangeController extends Controller
{
    public function __construct() {
        $this->middleware('perm:change,admin');
    }

    public function choose($slug) {
    	$user = Auth::user();
        $id = Event::where('slug', $slug)->first()->id;
        $user->active_event = $id;
        $user->save();

        return redirect('/home');
    }
}
