<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Model\User;
use App\Model\Cuestionario;
use App\Model\CuestionarioPreguntas;
use App\Model\CuestionarioPreguntasOpciones;
use App\Model\AsignacionCuestionario;

trait CuestionarioController
{

    public function inicio(Request $request){
    	$query = $request->get("query_search");
    	$cuestionarios = Cuestionario::search($query)->sortable()->paginate(10);
      $request->flashOnly(["query_search"]);
    	return view("admin.educacion",compact('cuestionarios'));
    }
    public function administrar(Request $request, $id=null){
    	$id = $id!= null ?  $id : $request->get("id");
    	$cuestionario=  Cuestionario::find($id);

    	if(  $request->isMethod("post")){
    		$data= $request->all();
    		$data['tipo'] =1 ; //TODO fijo

    		if( $cuestionario ==null){
    			$cuestionario = Cuestionario::create($data);
    			$cuestionario->save($data);
    		}else{
    			$cuestionario->update($data);
    		}
    		return $this->alertSuccess("La información del cuestionario fue guardado.",
          [ 'admin.educacion.administrar' ,  [ "id" => $cuestionario->id ]  ]
        );
    	}
    	return view("admin.educacion_configurar",compact('cuestionario'));
    }


    public function asignaCuestionario(Request $request, $id =null){

      if( !isset($id) ){
        return $this->alertError("Ingresa el id de un cuestionario.");
      }
      $cuestionario = Cuestionario::find($id);
      if( !isset($cuestionario)){
          return $this->alertError("No fue posible encontrar el cuestionario.");
      }

      $query = $request->get("query_search");

      $users = User::search($query)->sortable()->where( "id_role" ,"!=",User::ROLE_ADMIN  ) ->paginate(20);

      $request->flashOnly(["query_search"]);

        return  view('admin.educacion_asignar',compact('users','cuestionario'));

    }

    public function asignaUsuario(Request $request , $idUser, $idCuestionario){

      if(  !isset($idUser) ){
        return $this->alertError("Es necesario seleccionar un usuario.");
      }
      if ( !isset($idCuestionario)){
        return $this->alertError("Es necesario seleccionar una encuestas.");
      }

      $user= User::find($idUser);
      $cuestionarios = $user->cuestionarios()->wherePivot('id_cuestionario',$idCuestionario )->get();
      $msg="La encuesta fue  desasignada correctamente.";
      if( $cuestionarios->isNotEmpty()){
        $user->cuestionarios()->detach($idCuestionario);
      }
      else {
          $user->cuestionarios()->attach($idCuestionario);
        $msg="La encuesta fue asignada correctamente.";
      }
      return  $this->alertSuccess($msg) ;
    }

    public function verResultado($id){

      if(!isset($id)){
        return $this->alertError('Ingresa una asignacion valida.');
      }
      $asignacion= AsignacionCuestionario::find($id);
      if(!isset($asignacion)){
        return $this->alertError("No se encontro ninguna asignacion");
      }
    
      if( $asignacion->fecha_finalizado ==null ){
        return $this->alertError("El cuestionario aun no finaliza.");
      }
      $resultado = $asignacion->calcularCalificacion();

      return view('admin.educacion_asigna_resultado',compact('asignacion'));


    }


    public function eliminaCuestionario(Request $request , $id =null){
      if( !isset($id) ){
        return $this->alertError("Ingresa el id de un cuestionario.");
      }
      $cuestionario = Cuestionario::find($id);
      if( !isset($cuestionario)){
          return $this->alertError("No fue posible encontrar el cuestionario.");
      }
      $preguntas = $cuestionario->preguntas;

      foreach ($preguntas as $pregunta) {
          $opciones = $pregunta->opciones;
          foreach ($opciones  as  $opcion) {
            $opcion->delete();
          }
          $pregunta->delete();
      }
      $cuestionario->delete();
      return $this->alertSuccess("El cuestionario fue eliminado correctamente");
    }


    public function editarPregunta(Request $request ,$id=null){
    	$data=$request->all();
      $id = isset($id) ? $id : $data['id'];
    	$id_cuestionario = $data['id_cuestionario'];
    	$cuestionario=Cuestionario::find($id_cuestionario );

    	if(  $cuestionario== null){
    		return $this->alertError("Aun no se ha creado un cuestionario.");
    	}
      $inputs=[];
    	if( $id == null ){
    		$pregunta= new CuestionarioPreguntas( $data );
    		$cuestionario->preguntas()->save($pregunta);
            $inputs['id'] =$pregunta->id;
    	}
    	else {
    		$pregunta = $cuestionario->preguntas()->find($id);
    		$pregunta->update($data);
    	}
      $opciones = $request->get("opciones");
      if(isset($opciones)&& is_array($opciones)){
        foreach ($opciones as $key => $value) {
            $opciones[$key]['id_pregunta'] = $pregunta->id;
            $opciones[$key]['id_cuestionario'] = $pregunta->id_cuestionario;
            $opciones[$key]['es_correcto'] = isset($value['es_correcto']) ;
        }
        $nuevos = [];
        $editados = [];
        foreach ($opciones as $key => $opcion) {
          if(  !isset($opcion['id'])  ) {
              $nuevos[$key] = $opcion;
          }
          else{
            $editados [$key] =$opcion;
          }
        }
        if( !empty($nuevos)){
            $opciones =$pregunta->opciones()->createMany($nuevos);
            $index =0;
            foreach($nuevos as $key => $value){
              $inputs["opciones[$key][id]"]= $opciones->get($index)->id;
              $index++;
            }
        }
        if(!empty($editados)){
            foreach ($editados  as $key => $value) {
              $opcion=   CuestionarioPreguntasOpciones::find( $value['id'] );
              $opcion->update( $value  );
            }
        }

      }

      if( $id == null  ){
        return $this->alertSuccess(
        [
          'title' => "La pregunta fue guardada correctamente.",
          'results' => [
              'inputs' =>$inputs,
              'change'=> [
                [
                  'selector' =>  '.btn-add-opciones',
                  'attr' => ['data-id-value'=> $pregunta->id  ],
                  'closest' => '.tmpl-item'
                ],
                [
                    'text' => 'Pregunta '. $pregunta->secuencia,
                   'closest' =>'.tmpl-item',
                   'selector' => '.title-acor-btn'
                ],

                [
                  'selector' =>  '[name="id_pregunta"]',
                  'attr' => ['value'=> $pregunta->id  ],
                  'closest' => '.tmpl-item'
                ],
                [
                  'attr' => ['class'=> 'btn btn-success btn-ajax'  ] ,
                  'html' => 'Editar Pregunta',
                  'selector' => '.btn-ajax'
                ]

            ]

          ],
        ]
        );
      } else {
        	return $this->alertSuccess(["title" => "La pregunta fue editada correctamente.",
          'results' => [
              'inputs' =>$inputs,

            ]
        ]);
      }
    }
    public function eliminaPregunta(Request $request,$id=null){
      $id= $id==null ?  $request->get("id"):$id;
      if($id == null){
        return $this->alertError("ingresa id  de pregunta.");
      }
      $pregunta = CuestionarioPreguntas::find(  $id );
      $opciones=  CuestionarioPreguntasOpciones::where('id_pregunta', $id)->get();
      foreach ($opciones  as  $opcion) {
        $opcion->delete();
      }
      $pregunta->delete();
      return $this->alertSuccess("Se elimino la pregunta.");
    }

    public function guardarOpcion(Request $request ,$id=null){
      $data=$request->all();
      $id_pregunta = $data['id_pregunta'];
      $pregunta=CuestionarioPreguntas::find($id_pregunta );
      if(  $pregunta== null){
        return $this->alertError("Aun no se ha creado la pregunta.");
      }
      if( $id == null ){
        $opcion= new CuestionarioPreguntasOpciones( $data );
        $pregunta->opciones()->save($opcion);
        return $this->alertSuccess(
        [
          'title' => "La opción fue guardada correctamente.",
          'results' => [
              'inputs' =>['id' => $opcion->id ]

          ],
        ]
        );
      }
      else {
        $pregunta = $pregunta->preguntas()->find($id);
        $pregunta->update($data);
        return $this->alertSuccess("La opcion fue editada correctamente.");
      }

    }
    public function eliminaOpcion(Request $request,$id=null){
      $id= $id==null ?  $request->get("id"):$id;
      if($id == null){
        return $this->alertError("ingresa id  de pregunta.");
      }
      $opcion = CuestionarioPreguntasOpciones::find(  $id );
      if($opcion ==null){
        return $this->alertError("no fue posible encontrar la opcion.");
      }
      $opcion->delete();
      return $this->alertSuccess("Se elimino la opcion.");
    }

    public function verCuestionario(Request $request, $id=null ){
      if($id ==null){
        return $this->alertError("Ingresa un id de cuestionario valido");
      }

      $cuestionario = Cuestionario::find($id);

      if( !isset($cuestionario) ){
        return $this->alertError("No existe cuestionario.");
      }

      return view('admin.educacion_ver_cuestionario',compact('cuestionario'));

    }





}
