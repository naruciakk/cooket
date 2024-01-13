<?php

namespace App\Http\Controllers\Org;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Guest;
use App\Payment;

use Auth;

class SummaryController extends Controller
{
	public function __construct() {
		$this->middleware('tenant');
		$this->middleware('perm:summary,org');
	}

	public function index() {
		$user = Auth::user();
		$signing = Guest::where('sign', '!=', NULL)->where('event', $user->active_event)->count();
		$guests = Guest::where('event', $user->active_event)->count();
		$guests = ($guests == 0) ? 1 : $guests;
		$paid = Payment::where('event', $user->active_event)->where('paid', '!=', 0)->sum('amount');
		$total = Payment::where('event', $user->active_event)->sum('amount');

		return view('org.summary.summary')
			->with('guests', $guests)
			->with('paid', $paid)
			->with('total', $total)
			->with('signing', $signing);
	}
}
