<?php

namespace App\Http\Controllers\Org;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\UserRole;
use App\User;
use App\Event;
use App\Guest;

use Auth;

class UserRolesController extends Controller
{

	public function __construct() {
        $this->middleware('tenant');
		$this->middleware('perm:userroles,org');
	}

    public function index() {
        $user = Auth::user();
        $roles = UserRole::where('event', $user->active_event)->get();
        $users = User::all();
        $guests = Guest::where('event', $user->active_event)->where('user', '>', 0)->get();

        return view('org.userroles.list')
            ->with('roles', $roles)
            ->with('users', $users)
            ->with('guests', $guests);
    }

    public function add(Request $request) {
        $this->validate($request, [
            'user' => 'required|integer',
            'role' => 'required',
        ]);

        $org = Auth::user();
        $user = User::findOrFail($request->user);
        $role = new UserRole;

        $role->user = $request->user;
        $role->role = $request->role;
        $role->event = $org->active_event;

        $user->active_event = $org->active_event;

        $role->save();
        $user->save();

        return redirect('/userroles');      
    }

    public function delete($id) {
        $role = UserRole::findOrFail($id);

        $role->delete();

        return redirect('/userroles');
    }
}
