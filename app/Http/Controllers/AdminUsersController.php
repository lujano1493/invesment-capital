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

     public function validateFields(){
        return [
                    'name' =>'required',
                    'last_name' =>'required',
                    'nickname' =>'required',
                    'birth_date' =>'required|date',
                    'email' =>'required|unique:users'
                ];
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

    public function register(Request $request){

        if($request->isMethod('post')){
            $dataValidate= $request->validate(
                $this->validateFields(), 
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


   


    public function edit($id){

        $user= User::find($id);

        if( $user == null ){
            $this->alertWarning('No fue posible encontrar usuario.');
        }

        return view('admin.users_edit',compact('user'));
    }

    public function editProfile(Request $request, $id  ){
        $user= User::find($id);
        if( $user == null ){
            $this->alertWarning('No fue posible encontrar usuario.');
        }

        $validate= $this->validateFields();

        $emailCurrent = $request->get('email_current');
        $email = $request->get('email');

        if( $email === $emailCurrent){
            unset( $validate['email'] );
        }

        $dataValidate= $request->validate( $validate, $this->messages());
        if(!$user->update(  $dataValidate )){
            return $this->alertError('No fue posible actualizar perfil de usuario','admin/users');
        }
        return $this->alertSuccess('el perfil de usuario fue actulizado correctamente','admin/users');
    }
    public function editAccess(Request $request, $id){


        dd( $request -> all() );


    }


}
