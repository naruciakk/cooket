<?php

namespace App\Support;

use Illuminate\Http\Request;

use App\Event;
use App\User;
use App\AdminRole;
use App\UserRole;

use Auth;

class MenuBuilder {

	public static function checkIf($checkedRole, $role, $user) {
		if($role->role == 'admin' && 
			$role instanceof AdminRole)
			return true;

		if($role->role == 'org' && 
			$role->event == $user->active_event && 
			$role instanceof UserRole)
			return true;

		if($role->role == $checkedRole && 
			$role->event == $user->active_event) 
			return true;

		return false;
	}

	public static function getEntry($role, & $written) {
		if(!isset($written[$role])) {
			$written[$role] = true;
			return '<li><a href="/'.$role.'"><span>'.trans('org.'.$role).'</span></a></li>';
		}
	}

	public static function buildMenu() {
		$written = array();
		$admin = "";
		$user = "";
		$events = "";
		$adminheader = '<ul class="sidebar-menu" data-widget="tree"><li class="header">'.trans('panel.admin').'</li>';
		$userheader = '<ul class="sidebar-menu" data-widget="tree"><li class="header">'.trans('org.orgpanel').'</li>';
		$eventsheader = '<ul class="sidebar-menu" data-widget="tree"><li class="header">'.trans('panel.events').'</li>';
		$eventList = Event::orderBy('start', 'DESC')->get();

		if(Auth::check()) {
			$data = Auth::user();
			$roles = AdminRole::where('user', $data->id);
			$uroles = UserRole::where('user', $data->id);

			foreach ($roles->get() as $role) {
				if(MenuBuilder::checkIf('events', $role, $data))
					$admin .= MenuBuilder::getEntry('events', $written);
				if(MenuBuilder::checkIf('users', $role, $data))
					$admin .= MenuBuilder::getEntry('users', $written);
				if(MenuBuilder::checkIf('roles', $role, $data))
					$admin .= MenuBuilder::getEntry('roles', $written);
				if(MenuBuilder::checkIf('orgs', $role, $data))
					$admin .= MenuBuilder::getEntry('orgs', $written);
			}

			foreach ($roles->get() as $role) {
				if(MenuBuilder::checkIf('summary', $role, $data))
					$user .= MenuBuilder::getEntry('summary', $written);
				if(MenuBuilder::checkIf('guests', $role, $data))
					$user .= MenuBuilder::getEntry('guests', $written);
				if(MenuBuilder::checkIf('tickets', $role, $data))
					$user .= MenuBuilder::getEntry('tickets', $written);
				if(MenuBuilder::checkIf('signing', $role, $data))
					$user .= MenuBuilder::getEntry('signing', $written);
				if(MenuBuilder::checkIf('transfers', $role, $data))
					$user .= MenuBuilder::getEntry('transfers', $written);
				if(MenuBuilder::checkIf('userroles', $role, $data))
					$user .= MenuBuilder::getEntry('userroles', $written);
				if(MenuBuilder::checkIf('forms', $role, $data))
					$user .= MenuBuilder::getEntry('forms', $written);
			}

			foreach ($uroles->get() as $role) {
				if(MenuBuilder::checkIf('summary', $role, $data))
					$user .= MenuBuilder::getEntry('summary', $written);
				if(MenuBuilder::checkIf('guests', $role, $data))
					$user .= MenuBuilder::getEntry('guests', $written);
				if(MenuBuilder::checkIf('tickets', $role, $data))
					$user .= MenuBuilder::getEntry('tickets', $written);
				if(MenuBuilder::checkIf('signing', $role, $data))
					$user .= MenuBuilder::getEntry('signing', $written);
				if(MenuBuilder::checkIf('transfers', $role, $data))
					$user .= MenuBuilder::getEntry('transfers', $written);
				if(MenuBuilder::checkIf('userroles', $role, $data))
					$user .= MenuBuilder::getEntry('userroles', $written);
				if(MenuBuilder::checkIf('forms', $role, $data))
					$user .= MenuBuilder::getEntry('forms', $written);
			}
		}

		foreach ($eventList as $event) {
			if($event->finish >= date('Y-m-d H:i:s')) {
					$ename = $event->name;
					if(strlen($event->name) > 25) $ename = substr($ename, 0, 25) . "…";		
					$events .= '<li><a href="/'.$event->slug.'"><i class="fa fa-circle-o text-'.$event->color.'"></i> <span>'.$ename.'</span></a></li>';
			}
		}

		$events .= '<li><a href="/history"><span>'.trans('panel.history').'</span></a></li>';

		$output = "";

		if($admin != "")
			$output .= $adminheader.$admin.'</ul>';
		if($user != "")
			$output .= $userheader.$user.'</ul>';
		if($events != "")
			$output .= $eventsheader.$events.'</ul>';

		return $output;
	}

	public static function buildPicker() {
		$role = AdminRole::where('user', Auth::id())->where('role', 'change')->count();
		$current = Auth::user()->active_event;
		$events = Event::all();
		$ret = '';

		if($role) {
			$ret .= '<h3 class="control-sidebar-heading">'.trans('panel.event').'</h3><ul class="control-sidebar-menu">';

			foreach ($events as $event) {
				$sign = "";
				if($event->id == $current) $sign = "fa fa-close";

				$ret .= '<li>
		            <a href="/choose/'.$event->slug.'">
		              <i class="menu-icon '.$sign.' bg-'.$event->color.'"></i>

		              <div class="menu-info">
		                <h4 class="control-sidebar-subheading">'.$event->name.'</h4>
		                <p>'.$event->city.'</p>
		              </div>
		            </a>
	         	</li>';
			}

			$ret .= '</ul>';
		}

		return $ret;
	}
}
