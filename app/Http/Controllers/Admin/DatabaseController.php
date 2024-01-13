<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Database;

class DatabaseController extends Controller
{
	public function __construct() {
		$this->middleware('perm:orgs,admin');
	}

    public function add(Request $request, $org) {
        $this->validate($request, [
            'database' => 'required|min:2|max:255',
            'host' => 'required|min:2|max:255',
            'username' => 'required|min:2|max:255',
            'password' => 'required|min:2|max:255',
        ]);

        $db = new Database;

        $db->organization = $org;
        $db->name = $request->database;
        $db->host = $request->host;
        $db->username = $request->username;
        $db->password = $request->password;

        $db->save();

        return redirect('/orgs/'.$org);    	
    }

    public function edit($id) {
        $database = Database::findOrFail($id);

        return view('admin.org.database', compact('database', $database));
    }

    public function save(Request $request, $id) {
        $this->validate($request, [
            'database' => 'required|min:2|max:255',
            'host' => 'required|min:2|max:255',
            'username' => 'required|min:2|max:255',
            'password' => 'required|min:2|max:255',
        ]);

        $db = Database::findOrFail($id);

        $db->name = $request->database;
        $db->host = $request->host;
        $db->username = $request->username;
        $db->password = $request->password;

        $db->save();

        return redirect('/orgs/'.$db->organization);    	
    }

}
