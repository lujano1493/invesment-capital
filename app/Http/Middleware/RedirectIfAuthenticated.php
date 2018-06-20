<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user=  Auth::user();
            $redirectTo =  User::ROLE_ADMIN == $user->id_role ? '/admin/users' : 'capital/inicio';
            return redirect($redirectTo);
        }

        return $next($request);
    }
}
