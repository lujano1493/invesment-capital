<?php
namespace App\Util;

class MsgStatusFacade{

 	 static function  redirectSuccess($route,$message){
      return    self::redirectMsg($route,"ok",$message);
    }
    static function  redirectWarning($route,$message){
      return  self::redirectMsg($route,"warning",$message);
    }
    static function  redirectError($route,$message){
      return  self::redirectMsg($route,"error",$message);
    }

    static function   redirectMsg($route=null,$status,$message){
    	$msg= compact('status','message');
    	if( $route ===null ){
    		return redirect()->back()->with("alert", $msg);
    	}
      return  redirect()->route($route)->with("alert",$msg);
    }


}