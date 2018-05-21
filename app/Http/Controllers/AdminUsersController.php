<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;

class AdminUsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    	$users = User::orderBy('id' ,'desc')->paginate(25);
        return  view('admin.users',compact('users'));
    }

    public function register(Request $request){

        if($request->isMethod('post')){
            $dataValidate= $request->validate(
                [
                    'name' =>'required',
                    'last_name' =>'required',
                    'nickname' =>'required',
                    'birth_date' =>'required|date',
                    'email' =>'required|unique:users',
                    'password' =>'required|confirmed'
                ], 
                $this->messages()
            );

            if ( User::create( $dataValidate ) ){
                return $this->alertSuccess("Un nuevo usuario fue creado correctamente.",'admin/users');
            } else{
                return $this->alertError("No fue posible crear el usuario intenlo más tarde.",'admin/users');
            }

        }


    	return view('admin.users_register');
    }


    public function messages()
    {
        return [
            'name.required' => 'Ingresa nombre',
            'last_name.required'  => 'Ingresa apellido',
            'nickname.required' =>'Ingresa un nombre de usuario',
            'birth_date.required' =>'Ingresa fecha de nacimiento',
            'birth_date.date' =>'Ingresa una fecha de nacimiento valida',
            'email.required' =>'Ingresa correo electrónico',
            'email.unique' =>'ya existe en el sistema el correo a registrar',
            'password.required'=>'Ingresa contraseña',
            'password.confirmed' =>'La confirmación de contraseña no coinciden'
        ];

    }
}
