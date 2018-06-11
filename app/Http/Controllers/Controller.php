<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Util\MsgStatusFacade;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function alertError($message ,  $redirectTo=null){
        return MsgStatusFacade::redirectError($redirectTo,$message);
    }

    protected function alertSuccess($message ,  $redirectTo=null){
        return MsgStatusFacade::redirectSuccess($redirectTo,$message);
    }
    protected function alertWarning($message ,  $redirectTo=null){
        return MsgStatusFacade::redirectWarning($redirectTo,$message);
    }

    protected function alertJsonSuccess($message, $results=null){
        return MsgStatusFacade::responseJsonSuccess($message,$results);
    }

    protected function alertJsonError($message, $validationFields=null){
        return MsgStatusFacade::responseJsonError($message,$validationFields);
    }

      protected function alertJsonWarning($message,$validationFields=null,$results=null){
        return MsgStatusFacade::responseJsonWarning($message,$validationFields,$results);
    }


}
