<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\ProfileInvesment;
use App\Model\HorizonInvesment;
use App\Model\TypeObjective;
use App\Model\Contract;
use App\Model\TypeRepresentant;


class AdminInvesmentController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('auth.admin');
  }



  private  $fieldsValidateContract=[
                    'id_profile_invesment' =>'required',
                    'id_horizon_invesment' =>'required',
                    'id_type_objective' =>'required'
                ];

  private $fieldMessageContract=[
            'id_profile_invesment.required'  => 'Selecciona un perfil de inversión.',
            'id_horizon_invesment.required' =>'Selecciona un horizonte de inversión.',
            'id_type_objective.required' =>'Selecciona un objetivo.'
        ];
  
    public function inicio(Request $request){
    	$query = $request->get("query_search");

    	$users = User::search($query)->sortable()->where( "id_role" ,"!=",User::ROLE_ADMIN  ) ->paginate(10);
      	$request->flashOnly(["query_search"]);
    	return view("admin.invesment",compact('users'));
    }

    public function edit($id){

        $user= User::find($id);
        if( $user == null ){
            return $this->alertWarning('No fue posible encontrar usuario.');
        }
        $catProfile= ProfileInvesment::pluck('name','id')->all();
        $catHorizon=HorizonInvesment::pluck('name','id')->all();
        $catTypeObjective=TypeObjective::pluck('name','id')->all();
        $catTypeReprensentant= TypeRepresentant::pluck('name','id')->all();

        return view('admin.invesment_edit',compact('user','catProfile','catHorizon','catTypeObjective','catTypeReprensentant'));
    }


    public function editContract(Request $request,$id){
        $user =  User::find($id);
        if( $user == null ){
            return $this->alertWarning('No fue posible encontrar usuario.');
        }
        $contrato=$user->contract;
        $request->validate( $this->fieldsValidateContract, $this->fieldMessageContract);
        $data= $request->all(); 
        if( $contrato == null){
            $user->contract()->save(  new Contract($data) );
        }
        else {
           $contrato->update($data);
        }

        return $this->alertSuccess("La información del contrato fue guardada correctamente.");

    }


}
