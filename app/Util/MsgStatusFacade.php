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


    static function responseJsonSuccess($message,$results=null){
      return self::responseJsonMsg("ok",$message,null, $results);
    }
    static function responseJsonError($message,$validationFields=null){
      return self::responseJsonMsg("error",$message, $validationFields,null);
    }

    static function responseJsonWarning($message,$validationFields=null,$results=null){
      return self::responseJsonMsg("warning",$message, $validationFields,$results);
    }


    static function responseJsonMsg($status,$message ,$validationFields=null  ,$results=null){
      $msg =compact("status","message");

      if( isset($validationFields) && !empty($validationFields) ){
        $msg["validationFields"] =$validationFields;
      }
      if( isset($results)  ){
        $msg["results"] =$results;
      }
      return response()->json( $msg );
    }

    static function   redirectMsg($route=null,$status,$message){
    	$msg= compact('status','message');
    	if( $route ===null ){
    		return redirect()->back()->with("alert", $msg);
    	}
      return  redirect()->route($route)->with("alert",$msg);
    }


}