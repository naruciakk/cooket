<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Event;
use App\Organization;

class EventController extends Controller
{
    public function index($slug) {
    	$event = Event::select('name', 'address', 'website', 'slug', 'color', 'description', 'image', 'contact', 'start', 'finish', 'city')
    		->where('slug', $slug);
    	if($event->count() == 0)
    		return response()->json(null, 404);

    	return response()->json($event->first(), 200);
    }

    public function list($slug) {
    	$org = Organization::where('slug', $slug);
    	if($org->count() == 0) return response()->json(null, 404);
    	$event = Event::select('name', 'address', 'website', 'slug', 'color', 'description', 'image', 'contact', 'start', 'finish', 'city')
    		->where('organization', $org->first()->id);
    	if($event->count() == 0)
    		return response()->json(null, 404);

    	return response()->json($event->get(), 200);
    }

    public function org($slug) {
    	$org = Organization::select('name', 'address', 'account_number', 'website', 'slug', 'color')->where('slug', $slug);
    	if($org->count() == 0)
    		return response()->json(null, 404);

    	return response()->json($org->first(), 200);
    }
}
