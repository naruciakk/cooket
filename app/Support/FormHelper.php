<?php

namespace App\Support;

use Illuminate\Http\Request;

use App\FormType;
use App\Form;
use App\Guest;
use App\GuestData;
use App\FormField;

use Auth;

class FormHelper {

	public static function getName($id) {
		$user = Auth::user();
		$data = GuestData::where('guest', $id)->first();
		return $data->given_name.' '.$data->family_name;
	}

	public static function getInfo($id) {
    	$form = Form::findOrFail($id);
    	$fields = FormField::where('form', $form->id)->get();
    	$ret = '';
    	foreach ($fields as $field) {
    		$ret .= mb_substr($field->value, 0, 12);
    		$ret .= ', ';
    	}
    	return $ret;
	}

}
