<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\AdminRole;
use App\User;
use App\Event;

class AdminRoleController extends Controller
{

	public function __construct() {
		$this->middleware('perm:adminroles,admin');
	}

    public function index() {
        $roles = AdminRole::all();
        $users = User::all();

        return view('admin.adminrole.list', compact('roles', $roles), compact('users', $users));
    }

    public function add(Request $request) {
        $this->validate($request, [
            'user' => 'required|integer',
            'role' => 'required',
        ]);

        $role = new AdminRole;

        $role->user = $request->user;
        $role->role = $request->role;

        $role->save();

        return redirect('/roles');    	
    }

    public function delete($id) {
    	$role = AdminRole::findOrFail($id);

        $role->delete();

        return redirect('/roles');
    }
}
