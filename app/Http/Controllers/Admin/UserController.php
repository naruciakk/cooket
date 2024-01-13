<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
	public function __construct() {
		$this->middleware('perm:users,admin');
	}

    public function index() {
    	$users = User::all();

        return view('admin.users.list', compact('users', $users));
    }

    public function edit($id) {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user', $user));
    }

    public function save(Request $request, $id) {
        $this->validate($request, [
            'given_name' => 'required|min:5|max:255',
            'family_name' => 'required|min:5|max:255',
            'nickname' => 'min:2|max:50',
            'email' => 'required|email|max:255',
            'city' => 'required|max:50',
        ]);

        $user = User::findOrFail($id);

        $user->given_name = $request->given_name;
        $user->family_name = $request->family_name;
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->city = $request->city;

        $user->save();

        return redirect('/users');
    }

    public function delete($id) {
    	$user = User::findOrFail($id);

        $user->delete();

        return redirect('/users');
    }
}
