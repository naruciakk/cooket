<?php

namespace App\Http\Controllers\Org;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\FormType;
use App\Form;
use App\Guest;
use App\FormField;

use Auth;

class FormController extends Controller
{
	public function __construct() {
		$this->middleware('tenant');
		$this->middleware('perm:forms,org');
	}

    public function index() {
    	$user = Auth::user();
    	$formTypes = FormType::where('event', $user->active_event)->get();
    	return view('org.forms.types')
            ->with('formTypes', $formTypes);
    }

    public function list($id) {
    	$user = Auth::user();
    	$type = FormType::findOrFail($id);
    	if($type->event != $user->active_event) return redirect('/');
    	$guests = Guest::where('event', $user->active_event)->get();
    	$forms = Form::where('type', $id)->get();
    	return view('org.forms.list')
    		->with('forms', $forms)
    		->with('guests', $guests)
            ->with('type', $type);
    }

    public function show($type, $id) {
    	$user = Auth::user();
    	$type = FormType::findOrFail($type);
    	if($type->event != $user->active_event) return redirect('/');
    	$form = Form::findOrFail($id);
    	$fields = FormField::where('form', $form->id)->get();
    	return view('org.forms.show')
    		->with('fields', $fields)
            ->with('type', $type);
    }

}
