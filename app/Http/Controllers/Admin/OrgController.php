<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Organization;
use App\Database;

class OrgController extends Controller
{
	public function __construct() {
		$this->middleware('perm:orgs,admin');
	}

    public function index() {
    	$orgs = Organization::all();

        return view('admin.org.list', compact('orgs', $orgs));
    }

    public function add(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'account' => 'required|max:255',
            'website' => 'required|max:255',
            'slug' => 'required|min:2|max:255',
        ]);

        $org = new Organization;

        $org->name = $request->name;
        $org->address = $request->address;
        $org->account_number = $request->account;
        $org->website = $request->website;
        $org->slug = $request->slug;
        $org->color = $request->color;

        $org->save();

        return redirect('/orgs');    	
    }

    public function edit($id) {
        $org = Organization::findOrFail($id);
        $databases = Database::where('organization', $org->id)->get();

        return view('admin.org.edit', compact('org', $org), compact('databases', $databases));
    }

    public function save(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'account' => 'required|max:255',
            'website' => 'required|max:255',
            'slug' => 'required|min:2|max:255',
        ]);

        $org = Organization::findOrFail($id);

        $org->name = $request->name;
        $org->address = $request->address;
        $org->account_number = $request->account;
        $org->website = $request->website;
        $org->slug = $request->slug;
        $org->color = $request->color;

        $org->save();

        return redirect('/orgs');
    }

}
