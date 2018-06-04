<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectIfNotAdmin
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null){
      $user  = Auth::guard($guard)->user();
      if(  $user  && $user->isAdmin()){
          return $next($request);
      }
      if ($request->ajax())
      {
          return response('Forbbiden.', 403);
      }
      else
      {
          $status = "error";
          $message = "Acceso Restringido.";

           return  redirect()->route("capital.inicio")->with("alert",compact('status','message'));
      }


    }

  }
