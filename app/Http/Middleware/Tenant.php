<?php

namespace App\Http\Middleware;

use App\Support\TenantConnector;
use Closure;

use App\Organization;
use App\Event;
use App\Database;

use Auth;

class Tenant
{
    use TenantConnector;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $slug = $request->route('slug');
        $user = NULL;
        $db = NULL;
        if(Auth::check()) 
            $user = Auth::user();

        if($user != NULL && $user->active_event != 0) {
            $event = Event::findOrFail($user->active_event);
            $db = Database::where('id', $event->db);
            if($db == NULL) return redirect('/');
            $db = $db->first();
        }

        if($slug != NULL) {
            $event = Event::where('slug', $slug);
            if($event->count() == 0) return redirect('/');

            $event = $event->first();

            $db = Database::where('id', $event->db);
            if($db == NULL) return redirect('/');
            $db = $db->first();
        }

        if($db == NULL) {
            $event = Event::first();
            $db = Database::where('id', $event->db);
            if($db == NULL) return redirect('/');
            $db = $db->first();
        }

        if($db == NULL) return redirect('/');

        $this->reconnect($db);
        
        return $next($request);
    }
}