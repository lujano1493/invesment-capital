<?php

namespace App\Util;


use Illuminate\Support\Facades\Request;

class MsgStatusFacade{

 	 static function  redirectSuccess($route,$message,$results=null){
       return  self::redirectMsg($route,"ok",$message);
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


    static function responseJsonMsg($status,$message ,$validationFields=null  ,$results=[]){
      $msg =compact("status","message");
      if( isset($validationFields) && !empty($validationFields) ){
        $msg["validationFields"] =$validationFields;
      }
      if(  $results !=null  ){
        $msg['results'] = $results;
      }
      return response()->json( $msg );
    }

    static function   redirectMsg($route=null,$status,$message){
    	$msg= compact('status','message');
      $isAjax = is_array( $message) && isset($message['isAjax']) ? $message['isAjax']  : false;
      if ( !Request::ajax() && !$isAjax ){
        if( is_array($message) ){
          $msg['message'] = $message['title'];
        }
        if( $route ===null ){
          $route= Request::session()->get("routeModule");
          if( isset($route)  ){
            redirect()->route($route,[])->with("alert",$msg);
          }
          return redirect()->back()->with("alert", $msg);
        }
        $name = is_array($route) ? $route[0] : $route;
        $params = is_array($route) && count($route) >=2  ? $route[1] : [];
        return  redirect()->route($name,$params)->with("alert",$msg);
      }
      else{
          if( is_string($message) ){
              $message = ["title" =>$message   ];
          }
          if(!isset($message['validationFields'])){
              $message['validationFields'] = null;
          }
          if(!isset($message['results'])){
              $message['results'] = null;
          }
          if( $route !==null){
              // Agregar campo de redireccionado
          }
        return self::responseJsonMsg($status,$message['title'],$message['validationFields'],$message['results']);
      }


    }


}
