<?php

namespace App\Http\Controllers\User;

use Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Model\StatusUser;
use App\Model\Modules;
use App\Model\User;


trait UserProfileController{


	public function profile()
    {
        $catEstatus=  StatusUser::pluck("name","id")->all() ;
        $catModulos = Modules::pluck("name","id")->all();
        return view('capital.perfil_index',compact('catEstatus','catModulos'));
    }

    public function editProfile(Request $request, $field ){

    		$fieldValidation = [ "password" => $request->get("password") ];
			$validator = Validator::make( $fieldValidation, [
		            'password' => 'required'
		        ],[
		        	"password.required" =>"Ingresa contraseña."
		        ]);

			if($validator->fails() ){
				return $this->alertJsonError( "Error al validar credenciales." ,$validator->messages());
			}
			$password =$request->get("password") ;
			$user = Auth::user();


			if(!Hash::check($password, $user->password)) {
			       	return $this->alertJsonError("Credenciales no validas, vuelva intentar.");
			 }

			if( $field === "nickname") {
				$validator = Validator::make( $request->all(), [
		            'nickname' => 'required|confirmed'
		        ],[
		        	"nickname.required" =>"Ingresa nombre de usuario.",
		        	"nickname.confirmed" => "No coenciden la confirmación."
 		        ]);
 		        if($validator->fails() ){
 		        	return $this->alertJsonError("Error al validar nombre de usuario", $validator->messages());
				}
				$user->nickname = $request->get("nickname");

				if( $user->save()  ){
					return $this->alertJsonSuccess("Se guardo el nombre de usuario correctamente.", ["nickname" => $user->nickname]);
				}
				else{
					return $this->alertJsonError("No fue posible guardar el cambio, intente más tarde.");
				}

			}

			if( $field ==="password"){
				$validator = Validator::make( $request->all(), [
		            'password_change' => 'required|confirmed'
		        ],[
		        	"password_change.required" =>"Ingresa contraseña.",
		        	"password_change.confirmed" => "No coencide la confirmación."
 		        ]);
 		        if($validator->fails() ){
 		        	return $this->alertJsonError("Error al validar contraseña.", $validator->messages());
				}
				$user->password = Hash::make($request->get("password_change"));
				if( $user->save()  ){
					return $this->alertJsonSuccess("Se guardo la contraseña correctamente.");
				}
				else{
					return $this->alertJsonError("No fue posible guardar el cambio, intente más tarde.");
				}


			}

			if( $field ==="email"){
				$validator = Validator::make( $request->all(), [
		            'email' => 'required|email|confirmed|unique:users'
		        ],[
		        	"email.required" =>"Ingresa correo electrónico.",
		        	"email.confirmed" => "No coencide la confirmación."
 		        ]);
 		        if($validator->fails() ){
 		        	return $this->alertJsonError("Error al validar correo electrónico.", $validator->messages());
				}
				$user->email = $request->get("email");
				if( $user->save()  ){
					return $this->alertJsonSuccess("Se guardo el correo electrónico correctamente." , ["email" => $user->email]);
				}
				else{
					return $this->alertJsonError("No fue posible guardar el cambio, intente más tarde.");
				}

			}




    	}



}
