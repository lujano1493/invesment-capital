<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserInvestmentController;


use App\Model\AsignacionCuestionario;
use App\Model\CuestionarioUsuarioRespuesta;
use App\Model\CuestionarioPreguntasOpciones;

class CapitalController extends Controller
{

    use UserProfileController;
    use UserInvestmentController;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('capital.index');
    }




     public function educacion()
    {
        return view('capital.educacion_index');
    }

    public function constestar($id=null){

      if(!isset($id)){
        return $this->alertError('Ingresa una asignacion valida.');
      }
      $asignacion= AsignacionCuestionario::find($id);
      if(!isset($asignacion)){
        return $this->alertError("No se encontro ninguna asignacion");
      }
      $user = Auth::user();

      if( $user->id  != $asignacion->id_user){
        return $this->alertError("La asignacion no pertenece al usuario actual.");
      }
      return view('capital.educacion_cuestionario',compact('asignacion'));

    }

    public function guardar($id= null){

      if(!isset($id)){
        return $this->alertError('Ingresa una asignacion valida.');
      }
      $asignacion= AsignacionCuestionario::find($id);
      if(!isset($asignacion)){
        return $this->alertError("No se encontro ninguna asignacion");
      }
      $user = Auth::user();

      if( $user->id  != $asignacion->id_user){
        return $this->alertError("La asignacion no pertenece al usuario actual.");
      }


    }

    public function finalizar(Request $request,$id= null){

      if(!isset($id)){
        return $this->alertError('Ingresa una asignacion valida.');
      }
      $asignacion= AsignacionCuestionario::find($id);
      if(!isset($asignacion)){
        return $this->alertError("No se encontro ninguna asignacion");
      }
      $user = Auth::user();

      if( $user->id  != $asignacion->id_user){
        return $this->alertError("La asignacion no pertenece al usuario actual.");
      }
      $data= $request->all();
      
      if(!isset($data['opciones'])|| empty($data['opciones'])){
        return  $this->alertError("Debes seleccionar una opción");
      }

      $affectedRows= CuestionarioUsuarioRespuesta::where('id_asignacion', $id)->delete();

      $opciones = array_values($data['opciones']) ;
      $opciones = CuestionarioPreguntasOpciones::find($opciones);
      $opciones = $opciones->toArray();
      foreach ($opciones  as $key => $value) {
          $opciones[$key]['id_asignacion']  = $id;
          $opciones[$key]['id_opcion']  =  $value['id'];
          $opciones[$key]['id_user'] =  $user->id;
          unset( $opciones[$key]['id']);

      }
      $asignacion->respuestas()->createMany($opciones);
      $asignacion->fecha_finalizado= date("Y-m-d H:i:s");
      $asignacion->update();
      return $this->alertSuccess("El cuestinoario fue guardado correctamente");


    }






}
