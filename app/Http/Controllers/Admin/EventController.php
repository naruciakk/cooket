<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Event;
use App\Organization;

class EventController extends Controller
{
	public function __construct() {
		$this->middleware('perm:events,admin');
	}

    public function index() {
        $events = Event::all();
        $orgs = Organization::all();

        return view('admin.event.list', compact('events', $events), compact('orgs', $orgs));
    }

    public function add(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:2|max:255',
            'description' => 'required',
            'slug' => 'required|max:255',
            'organization' => 'required|integer',
            'image' => 'required|max:255',
            'website' => 'required|max:255',
            'contact' => 'required|max:255',
            'start' => 'required',
            'finish' => 'required',
            'city' => 'required|max:255',
            'address' => 'required|max:255',
            'accomodation' => 'required|integer',
            'prepaid' => 'required|integer',
			'userimage' => 'required|integer',
			'code_length' => 'required'
        ]);

        $event = new Event();

        $event->name = $request->name;
        $event->color = $request->color;
        $event->description = $request->description;
        $event->slug = $request->slug;
        $event->organization = $request->organization;
        $event->image = $request->image;
        $event->website = $request->website;
        $event->contact = $request->contact;
        $event->start = $request->start;
        $event->finish = $request->finish;
        $event->city = $request->city;
        $event->address = $request->address;
        $event->accomodation = $request->accomodation;
        $event->prepaid = $request->prepaid;
		$event->userimage = $request->userimage;
		$event->code_length = $request->code_length;

        $event->save();

		Storage::disk('local')->makeDirectory($request->slug);

        return redirect('/events');    	
    }

    public function edit($id) {
        $event = Event::findOrFail($id);
        $org = Organization::findOrFail($event->organization);

        return view('admin.event.edit', compact('event', $event), compact('org', $org));
    }

    public function save(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|min:2|max:255',
            'description' => 'required',
            'image' => 'required|max:255',
            'website' => 'required|max:255',
            'contact' => 'required|max:255',
            'start' => 'required',
            'finish' => 'required',
            'city' => 'required|max:255',
            'address' => 'required|max:255',
            'accomodation' => 'required|integer',
            'prepaid' => 'required|integer',
			'userimage' => 'required|integer',
			'code_length' => 'required'
        ]);

        $event = Event::findOrFail($id);

        $event->name = $request->name;
        $event->color = $request->color;
        $event->description = $request->description;
        $event->image = $request->image;
        $event->website = $request->website;
        $event->contact = $request->contact;
        $event->start = $request->start;
        $event->finish = $request->finish;
        $event->city = $request->city;
        $event->address = $request->address;
        $event->accomodation = $request->accomodation;
        $event->prepaid = $request->prepaid;
		$event->userimage = $request->userimage;
		$event->code_length = $request->code_length;

        $event->save();

        return redirect('/events');
    }

    public function delete($id) {
    	$event = Event::findOrFail($id);

        $event->delete();

        return redirect('/events');
    }
}
