<?php

namespace App\Http\Middleware;

use App\AdminRole;
use App\UserRole;
use App\Event;

use Closure;
use Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $type)
    {
        if(Auth::check()) {
            $user = Auth::user();

            if($type == 'admin') {
                $check = 0;
                $check += AdminRole::where('user', $user->id)->where('role', 'admin')->count();
                $check += AdminRole::where('user', $user->id)->where('role', $role)->count();

                if($check == 0) return redirect('/login');
            }
            else {
                $check = 0;
                $check += AdminRole::where('user', $user->id)->where('role', 'admin')->count();
                $check += UserRole::where('user', $user->id)->where('role', 'org')->where('event', $user->active_event)->count();
                $check += UserRole::where('user', $user->id)->where('role', $role)->where('event', $user->active_event)->count();

                if($role == 'org') $check += UserRole::where('user', $user->id)->where('event', $user->active_event)->count();

                if($check == 0) return redirect('/login');
            }

            return $next($request);
        }
        else return redirect('/login');
    }
}
