<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected function alertError($message ,  $redirectTo=null){
        return $this->redirectMessage('error',$message,$redirectTo);
    }

    protected function alertSuccess($message ,  $redirectTo=null){
        return $this->redirectMessage('ok',$message,$redirectTo);
    }
    protected function alertWarning($message ,  $redirectTo=null){
        return $this->redirectMessage('warning',$message,$redirectTo);
    }


    protected function redirectMessage(  $status, $message , $redirectTo=null  ){
        return   $redirectTo ===null ?  back()->with('alert', compact('status','message'))
            : redirect($redirectTo) ->with('alert', compact('status','message'));
    }

}
