<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\GiveTickets;

use App\Organization;
use App\Event;
use App\Guest;
use App\Ticket;
use App\Payment;
use App\GuestData;
use App\OnlineGuest;
use App\FormType;
use App\Form;
use App\FormField;

use Auth;
use Cookie;
use DateTime;

class ShowTicketController extends Controller
{
    public function __construct() {
        $this->middleware('tenant');
    }

    public function index($slug) {
        if(Auth::check()) {
            $event = Event::where('slug', $slug)->first();
            $org = Organization::findOrFail($event->organization);
            $guests = Guest::where('event', $event->id)->where('user', Auth::user()->id);
            $types = Ticket::where('event', $event->id)->get();
            $onlines = OnlineGuest::all();

            return view('ticketlist')
                ->with('guests', $guests)
                ->with('types', $types)
                ->with('onlines', $onlines)
                ->with('event', $event);
        }
        return redirect('/login');
    }

    public function show($slug, $sha) {
        $ret = GiveTickets::checkTicket($slug, $sha);
        if($ret == 1) return redirect('/');
        if($ret == 2) return redirect('/login');
        if($ret == 3) return view('pin', compact('slug'), compact('sha'));

        $online = OnlineGuest::where('sha', $sha)->first();
        $guest = Guest::findOrFail($online->guest);
        $event = Event::findOrFail($guest->event);

        $data = GuestData::where('guest', $guest->id)->first();
        $org = Organization::findOrFail($event->organization);

        $payments = Payment::where('guest', $guest->id)->get();

        $forms = Form::where('ticket', $guest->id)->get();
        $formtypes = FormType::where('event', $event->id);

        return view('ticket')
            ->with('forms', $forms)
            ->with('formtypes', $formtypes)
        	->with('guest', $guest)
        	->with('event', $event)
    		->with('org', $org)
            ->with('sha', $sha)
    		->with('slug', $slug)
			->with('data', $data)
			->with('online', $online)
            ->with('payments', $payments);

    }

    public function pinSave($slug, $sha, Request $request) {
        $this->validate($request, [
            'pin' => 'required|min:4|max:4',
        ]);

        $check = OnlineGuest::where('sha', $sha);
        if($check->count() == 0) redirect('/');

        if(!password_verify($request->pin, $check->first()->pin)) 
            return redirect('/'.$slug.'/'.$sha);
            
        return redirect('/'.$slug.'/'.$sha)
            ->withCookie(cookie('sha', $sha))
            ->withCookie(cookie('pin', $check->first()->pin));
    }

    public function print($slug, $sha) {
        $ret = GiveTickets::checkTicket($slug, $sha);
        if($ret == 1) return redirect('/');
        if($ret == 2) return redirect('/login');
        if($ret == 3) return view('pin', compact('slug'), compact('sha'));

        $online = OnlineGuest::where('sha', $sha)->first();
        $guest = Guest::findOrFail($online->guest);
        $event = Event::findOrFail($guest->event);
        $data = GuestData::where('guest', $guest->id)->first();
        $org = Organization::findOrFail($event->organization);

        $toprint = str_replace("!code!", $guest->code, $event->ticket);

        return view('print')
                ->with('toprint', $toprint);

    }

    public function showForm($slug, $sha, $name) {
        $ret = GiveTickets::checkTicket($slug, $sha);
        if($ret == 1) return redirect('/');
        if($ret == 2) return redirect('/login');
        if($ret == 3) return view('pin', compact('slug'), compact('sha'));

        $event = Event::where('slug', $slug)->first();
        $type = FormType::where('slug', $name)->where('event', $event->id)->where('end', '>=', new DateTime('today'));
        if(!$type->count()) return redirect('/');
        $type = $type->first();
        $typename = "App\Support\SignUp\\".$type->type;
        $form = new $typename();

        return view('ticket_form')
            ->with('slug', $slug)
            ->with('sha', $sha)
            ->with('name', $name)
            ->with('event', $event)
            ->with('form', $form);
    }

    public function saveForm($slug, $sha, $name, Request $request) {
        $ret = GiveTickets::checkTicket($slug, $sha);
        if($ret == 1) return redirect('/');
        if($ret == 2) return redirect('/login');
        if($ret == 3) return view('pin', compact('slug'), compact('sha'));

        $event = Event::where('slug', $slug)->first();
        $type = FormType::where('slug', $name)->where('event', $event->id)->where('end', '>=', new DateTime('today'));
        if(!$type->count()) return redirect('/');
        $type = $type->first();
        $typename = "App\Support\SignUp\\".$type->type;
        $form = new $typename();
        $validate = array();
        foreach ($form->getFields() as $field) $validate[$field->getName()] = 'max:'.$field->getSize();
        $this->validate($request, $validate);

        $online = OnlineGuest::where('sha', $sha)->first();
        if($online == NULL) return redirect('/');

        $addForm = new Form;
        $addForm->ticket = $online->guest;
        $addForm->type = $type->id;
        $addForm->save();

        foreach ($form->getFields() as $field) {
            $addField = new FormField;
            $addField->form = $addForm->id;
            $addField->field = $field->getName();
            $na = $field->getName();
            $addField->value = $request->$na;
            $addField->save();
        }

        return redirect('/'.$slug.'/'.$sha);
    }

    public function showFormAfter($slug, $sha, $name, $id) {
        $ret = GiveTickets::checkTicket($slug, $sha, $id);
        if($ret == 1) return redirect('/');
        if($ret == 2) return redirect('/login');
        if($ret == 3) return view('pin', compact('slug'), compact('sha'));
        
        $form = Form::findOrFail($id);
        $formtype = FormType::findOrFail($form->type);
        $fields = FormField::where('form', $form->id)->get();
        $event = Event::where('slug', $slug)->first();

        return view('ticket_form_show')
            ->with('slug', $slug)
            ->with('sha', $sha)
            ->with('event', $event)
            ->with('fields', $fields)
            ->with('formtype', $formtype)
            ->with('form', $form);
    }

    public function editFormAfter($slug, $sha, $name, $id) {
        $ret = GiveTickets::checkTicket($slug, $sha, $id);
        if($ret == 1) return redirect('/');
        if($ret == 2) return redirect('/login');
        if($ret == 3) return view('pin', compact('slug'), compact('sha'));
        
        $form = Form::findOrFail($id);
        $formtype = FormType::findOrFail($form->type);
        $fields = FormField::where('form', $form->id)->get();
        $event = Event::where('slug', $slug)->first();
        $typename = "App\Support\SignUp\\".$formtype->type;
        $raw = new $typename();

        return view('ticket_form_edit')
            ->with('slug', $slug)
            ->with('sha', $sha)
            ->with('name', $name)
            ->with('event', $event)
            ->with('fields', $fields)
            ->with('formtype', $formtype)
            ->with('raw', $raw)
            ->with('form', $form);
    }

    public function saveFormAfter($slug, $sha, $name, $id, Request $request) {
        $ret = GiveTickets::checkTicket($slug, $sha, $id);
        if($ret == 1) return redirect('/');
        if($ret == 2) return redirect('/login');
        if($ret == 3) return view('pin', compact('slug'), compact('sha'));

        $event = Event::where('slug', $slug)->first();
        $type = FormType::where('slug', $name)->where('event', $event->id)->where('end', '>=', new DateTime('today'));
        if(!$type->count()) return redirect('/');
        $type = $type->first();
        $typename = "App\Support\SignUp\\".$type->type;
        $form = new $typename();
        $validate = array();
        foreach ($form->getFields() as $field) $validate[$field->getName()] = 'max:'.$field->getSize();
        $this->validate($request, $validate);

        $online = OnlineGuest::where('sha', $sha)->first();
        if($online == NULL) return redirect('/');

        $addForm = Form::findOrFail($id);
        $formfields = FormField::where('form', $addForm->id);
        if(!$formfields->count()) return redirect('/');

        foreach ($formfields->get() as $field) {
            $na = $field->field;
            $field->value = $request->$na;
            $field->save();
        }

        return redirect('/'.$slug.'/'.$sha.'/'.$name.'/'.$id);
	}

	public function uploadPhoto($slug, $sha, Request $request) {
		$ret = GiveTickets::checkTicket($slug, $sha);
        if($ret == 1) return redirect('/');
        if($ret == 2) return redirect('/login');
        if($ret == 3) return view('pin', compact('slug'), compact('sha'));
		$validate = array('userimage' => 'file|image|mimes:jpeg,png|max:2048');

		$online = OnlineGuest::where('sha', $sha)->first();
		if(strlen($online->userimage) != 0) return redirect('/'.$slug.'/'.$sha);
		$guest = Guest::findOrFail($online->guest);
		$event = Event::findOrFail($guest->event);
		$userimage = $request->file('userimage');

		if(isset($userimage)) {
			$uipath = $userimage->storeAs($event->slug, $guest->code.'.'.$userimage->extension());
			$online->userimage = $uipath;
		}

		$online->save();

		return redirect('/'.$slug.'/'.$sha);
	}

}
