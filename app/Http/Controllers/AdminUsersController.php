<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Modules;

class AdminUsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.admin');
    }
    public function index(Request $request )
    {

      $query = $request->get("query_search");
    	$users = User::search($query)->sortable()->where( "id_role" ,"!=", 1 ) ->paginate(10);
      $request->flashOnly(["query_search"]);


        return  view('admin.users',compact('users'));
    }

     public function validateFields($action = 'create'){
        $fields=[
                    'name' =>'required',
                    'last_name' =>'required',
                    'nickname' =>'required',
                    'birth_date' =>'required|date',
                    'email' =>'required|unique:users',
                    'password' =>'required',
                    'status' =>'required'
                ];


        if( $action ==='create'  ){
            unset($fields['status']);
        }
        if( $action ==='edit'  ){
            unset($fields['password']);
        }
        return $fields;
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
            'password.confirmed' =>'La confirmación de contraseña no coinciden',
            'status.required' =>'Seleccione un estatus'
        ];

    }

    public function register(Request $request){

        if($request->isMethod('post')){
            $dataValidate= $request->validate(
                $this->validateFields(),
                $this->messages()
            );

            if ( User::create( $dataValidate ) ){
                return $this->alertSuccess("Un nuevo usuario fue creado correctamente.",'admin.users');
            } else{
                return $this->alertError("No fue posible crear el usuario intenlo más tarde.",'admin.users');
            }

        }


    	return view('admin.users_register');
    }





    public function edit($id){

        $user= User::find($id);
        if( $user == null ){
            return $this->alertWarning('No fue posible encontrar usuario.');
        }
        $catEstatus= [
            -1 => "Bloqueada",
            0 => "Inactiva",
            1 => "Activa"
        ];
        $catModules=  Modules::pluck("name","id")->all();



        return view('admin.users_edit',compact('user','catEstatus','catModules'));
    }

    public function editProfile(Request $request, $id  ){
        $user= User::find($id);
        if( $user == null ){
            return $this->alertWarning('No fue posible encontrar usuario.');
        }

        $validate= $this->validateFields('edit');

        $emailCurrent = $request->get('email_current');
        $email = $request->get('email');

        if( $email === $emailCurrent){
            unset( $validate['email'] );
        }

        $dataValidate= $request->validate( $validate, $this->messages());
        if(!$user->update(  $dataValidate )){
            return $this->alertError('No fue posible actualizar perfil de usuario','admin.users');
        }
        return $this->alertSuccess('el perfil de usuario fue actulizado correctamente','admin.users');
    }
    public function editAccess(Request $request, $id){
      $user= User::find($id);
      if( $user == null ){
          return $this->alertWarning('No fue posible encontrar usuario.');
      }
      if( !$request->has('index') ){
          $id_module = $request->get('id_module');
          $date_expired = $request->get("date_expired");

            if( $user->modules()->wherePivot('id_module', $id_module)->get()->isNotEmpty() ){
                return $this->alertError("Ya existe el acceso al modulo ingresa uno diferente.");
            }

          if( !$user->modules()->attach(  [$id_module => [ 'date_expired' => $date_expired ]]   ) ){
            return $this->alertSuccess("El acceso fue registrado con éxito.");
          }else{
            return $this->alertError("No fue posible guardar el accesso, intente más tardes.");
          }
      } else{
         $index =  $request->get('index');
         $id = $request->get("id_$index");
         $id_module_current = $request->get("id_module_{$index}_current");
         $id_module = $request->get("id_module_{$index}");
         $date_expired = $request->get("date_expired_$index");
         if(     $id_module !== $id_module_current &&  $user->modules()->wherePivot('id_module', $id_module)->get()->isNotEmpty()   ){
                return $this->alertError("Ya existe el acceso al modulo ingresa uno diferente.");
            }

         if($user->modules()->updateExistingPivot($id_module_current,  ["date_expired" => $date_expired , "id_module" => $id_module  ]   ) ){
           return $this->alertSuccess("El acceso fue actualizado con éxito.");
         }else{
           return $this->alertError("No fue posible actualizar acceso, intente más tardes.");
         }


      }


    }

    public function deleteAccess(Request $request , $idUser,$id){
      $user= User::find($idUser);
      if( $user == null ){
            return $this->alertWarning('No fue posible encontrar usuario.');
      }
      if( $user->modules()->detach( $id) ){
          return $this->alertSuccess("El acceso fue eliminado correctamente.");
      }
      else{
        return $this->alertError("No fue posible eliminar acceso, intente más tarde.");
      }

    }


}
