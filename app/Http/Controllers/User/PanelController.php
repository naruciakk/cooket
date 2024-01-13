<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Guest;
use App\Ticket;
use App\Event;

use Validator;
use Hash;
use Auth;

class PanelController extends Controller
{
	public $passwordStatus;
	
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('tenant');
    }

    public function index() {
        $user = Auth::user();
        $events = Event::all();

        return view('user.panel.main')
                ->with('user', $user)
                ->with('events', $events);
    }

    public function save(Request $request) {
        $this->validate($request, [
            'given_name' => 'required|min:2|max:255',
            'family_name' => 'required|min:2|max:255',
            'nickname' => 'min:2|max:50',
            'city' => 'required|max:50',
        ]);

        $user = Auth::user();

        $user->given_name = $request->given_name;
        $user->family_name = $request->family_name;
        $user->nickname = $request->nickname;
        $user->city = $request->city;

        $user->save();

        return redirect('/home');
    }

    public function changePassword(Request $request) {
        $user = Auth::user();
        $passwordStatus = Hash::check($request->oldPassword, $user->password);

        $this->validate($request, [
            'oldPassword' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if(!$passwordStatus) {
            return redirect('/home');
        }

        $user = Auth::user();

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect('/home');
    }
}
