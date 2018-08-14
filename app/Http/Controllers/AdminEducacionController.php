<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Cuestionario;
use App\Model\CuestionarioPreguntas;

class AdminEducacionController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('auth.admin');
  }
  
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
    		return $this->alertSuccess("La información del cuestionario fue guardado.");
    	}

    	return view("admin.educacion_configurar",compact('cuestionario'));
    }


    public function editarPregunta(Request $request ,$id=null){
    	$data=$request->all();
    	$id_cuestionario = $data['id_cuestionario'];
    	$cuestionario=Cuestionario::find($id_cuestionario );

    	if(  $cuestionario== null){
    		return $this->alertError("Aun no se ha creado un cuestionario.");
    	}
    	if( $id == null ){
    		$pregunta= new CuestionarioPreguntas( $data );
    		$cuestionario->preguntas()->save($pregunta);
    		return $this->alertSuccess("La pregunta fue guardada correctamente.");
    	}
    	else {
    		$pregunta = $cuestionario->preguntas()->find($id);
    		$pregunta->update($data);
    		return $this->alertSuccess("La pregunta fue editada correctamente.");
    	}

    }
    public function eliminaPregunta(Request $request,$id=null){
      $id= $id==null ?  $request->get("id"):$id;
      if($id == null){
        return $this->alertError("ingresa id  de pregunta.");
      }
      $pregunta = CuestionarioPreguntas::find(  $id );
      $pregunta->delete();
      return $this->alertSuccess("Se elimino la pregunta.");
    }
}
