<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Util\MsgStatusFacade;

class NotAccessAction
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $ident){
      $user  = Auth::guard()->user();
      if( !$user  ){
        return MsgStatusFacade::redirectError("login","Es necesario ingresar al portal.");
      }
      $module = $user->modules()->where('ident',$ident  )->first();
      if(!$module){
        return MsgStatusFacade::redirectError("capital.inicio","No tiene permisos para acceder al módulo solicitado.");
      }
       $date_expired= $module->access->date_expired;
       $now = \Carbon\Carbon::today();
      if(   $now >  $date_expired   ){
         return  MsgStatusFacade::redirectError("capital.inicio","El acceso al módulo expiro. por favor pongase en contacto con el administrador"  );
      }

      $request->session()->flash( 'module' ,$module );
      return $next($request);
    }



  }
