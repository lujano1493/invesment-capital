<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserInvestmentController;


use App\Model\AsignacionCuestionario;
use App\Model\CuestionarioUsuarioRespuesta;
use App\Model\CuestionarioPreguntasOpciones;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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




     public function educacion(Request $request)
    {
        $request->session()->put("routeModule", "capital.educacion"  );
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
      if( $asignacion->fecha_finalizado !=null ){
        return $this->alertError("El cuestionario ya fue finalizado.");
      }
      $cuestionario = $asignacion->cuestionario;
      if( !$asignacion->visto ){
          $asignacion->visto = true;
          $asignacion->fecha_limite  = $cuestionario->tipo == 1 ? $cuestionario->fecha_limite: null;
          if( $cuestionario ->tipo == 2 ){
            list ($horas , $min) = preg_split('[:]',   $cuestionario->fecha_limite->format("H:i:s"));
            $asignacion->fecha_limite =  \Carbon\Carbon::now()->addHours($horas)-> addMinutes($min);
          }

          $asignacion->update();

      }

      if(  $asignacion->fecha_limite   &&  $asignacion->fecha_limite < Carbon::today() ){
        $asignacion->fecha_finalizado= date("Y-m-d H:i:s");
        $asignacion->update();
        return $this->alertError("El plazo a terminado y por lo tanto se finaliza la encuesta.");
      }

      return view('capital.educacion_cuestionario',compact('asignacion'));

    }

    public function guardar(Request $request,$id= null){
      if(!isset($id)){
        return $this->alertError("Ingresa una asignacion valida.");
      }
      $asignacion= AsignacionCuestionario::find($id);
      if(!isset($asignacion)){
        return $this->alertError("No se encontro ninguna asignacion");
      }
      $user = Auth::user();
      if( $user->id  != $asignacion->id_user){
        return $this->alertError("La asignacion no pertenece al usuario actual.");
      }
      if( $asignacion->fecha_finalizado !=null ){
        return $this->alertError("El cuestionario ya fue finalizado.");
      }

      $cuestionario=$asignacion->cuestionario;
      if( $asignacion->fecha_limite   &&  $asignacion->fecha_limite < Carbon::today() ){
        return $this->alertError("El plazo a terminado y por lo tanto no se puede guardar.");
      }

      $data= $request->all();
      $this->guardarOpciones($data['opciones'],$asignacion);

      $diffTime=   $asignacion->fecha_limite->timestamp -\Carbon\Carbon::now()->timestamp;
      return $this->alertSuccess( [
          'title' => "se guardo correctamente cuestionario.",
          'results' => compact('diffTime')
        ] );
    }

    public function finalizar(Request $request,$id= null){

      if(!isset($id)){
        return $this->alertError("Ingresa una asignacion valida.");
      }
      $asignacion= AsignacionCuestionario::find($id);
      if(!isset($asignacion)){
        return $this->alertError("No se encontro ninguna asignacion");
      }
      $user = Auth::user();

      if( $user->id  != $asignacion->id_user){
        return $this->alertError("La asignacion no pertenece al usuario actual.");
      }
      if( $asignacion->fecha_finalizado !=null ){
        return $this->alertError("El cuestionario ya fue finalizado.");
      }
      $data= $request->all();

      if(!isset($data['opciones'])|| empty($data['opciones'])){
        return  $this->alertError("Debes seleccionar una opción");
      }

      $this->guardarOpciones($data['opciones'],$asignacion);
      $asignacion->fecha_finalizado= date("Y-m-d H:i:s");
      $asignacion->update();
      return $this->alertSuccess("El cuestionario fue finalizado correctamente");

    }


    private function guardarOpciones($opciones,$asignacion){
      if(!is_array($opciones) ){
        return null;
      }
      $user = Auth::user();
      $affectedRows= CuestionarioUsuarioRespuesta::where('id_asignacion', $asignacion->id)->delete();
      $opciones = array_values($opciones) ;
      $opciones = CuestionarioPreguntasOpciones::find($opciones);
      $opciones = $opciones->toArray();
      foreach ($opciones  as $key => $value) {
          $opciones[$key]['id_asignacion']  = $asignacion->id;
          $opciones[$key]['id_opcion']  =  $value['id'];
          $opciones[$key]['id_user'] =  $user->id;
          unset( $opciones[$key]['id']);
      }
      return $asignacion->respuestas()->createMany($opciones);
    }

    public function resultado($id){

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

      if( $asignacion->fecha_finalizado ==null ){
        return $this->alertError("El cuestionario aun no finaliza.");
      }

      return view('capital.educacion_cuestionario_finalizado',compact('asignacion'));


    }

    public function intentar(Request $request,$id){
      if(!isset($id)){
        return $this->alertError("Ingresa una asignacion valida.");
      }
      $asignacion= AsignacionCuestionario::find($id);
      if(!isset($asignacion)){
        return $this->alertError("No se encontro ninguna asignacion");
      }
      $user = Auth::user();
      if( $user->id  != $asignacion->id_user){
        return $this->alertError("La asignacion no pertenece al usuario actual.");
      }
      $cuestionario= $asignacion->cuestionario;

      if(    $asignacion->fecha_finalizado  && $cuestionario->tipo == 2 ){
        return $this->alertError("No es posible intentar nueva la prueba ya que el limite tiempo termino.");
      }

      $asignacion->fecha_finalizado=null;
      $asignacion->visto= 0;
      $asignacion->update();
      $affectedRows= CuestionarioUsuarioRespuesta::where('id_asignacion', $asignacion->id)->delete();
      return $this->alertSuccess("Nuevo intento para contestar la encuesta.", ['capital.cuestionario.contestar', compact('id')]);

    }





}
