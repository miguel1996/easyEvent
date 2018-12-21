<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user) {
            if (strcmp($user->group->name, "admin") == 0) { //0 means that the string is equal
                return $next($request);
            }
        }
        $request->session()->flash('status',"You don't have Admin permissions");
        return redirect('/');
    }
}
