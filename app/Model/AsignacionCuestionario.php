<?php

namespace App\Model;

use \Illuminate\Database\Eloquent\Relations\Pivot;
use Collective\Html\Eloquent\FormAccessible;

class AsignacionCuestionario extends Pivot
{
  use FormAccessible;

  public $table="asignacion_cuestionarios";
  public $timestamps=false;

  protected $dates = [
      'fecha_finalizado'
  ];

  public function formFechaFinalizadoAttribute($value){
      return $value->format('Y-m-d');
  }


  public function cuestionario(){
    return $this->belongsTo("App\Model\Cuestionario","id_cuestionario");
  }

  public function usuario(){
    return $this->belongsTo("App\Model\User","id_user");
  }

  public function respuestas(){
    return $this->hasMany("App\Model\CuestionarioUsuarioRespuesta","id_asignacion");
  }


  public function calcularCalificacion (){

  $cuestionario = $this->cuestionario;
  $respuestas =$this->respuestas;
  $respuestas= $respuestas->pluck('id','id_opcion')->toArray();
  $preguntas=$cuestionario->preguntas()->orderBy('secuencia','asc')->get();
   $preguntasCorrectas=0;
   foreach( $preguntas  as $pregunta  ){
     $opcionesCorrecta=0;
     $opcionesCorrectasSeleccionadas=0;
     $opciones =  $pregunta->opciones()->orderBy('enciso','asc') ->get();
       foreach( $opciones as  $opcion ){
       $opcionSeleccionada= isset(  $respuestas[ $opcion->id ]   );
       if($opcion->es_correcto){
           $opcionesCorrecta++;
       }
       if($opcion->es_correcto && $opcionSeleccionada ) {
            $opcionesCorrectasSeleccionadas++;
       }
     }
     if($opcionesCorrectasSeleccionadas == $opcionesCorrecta ){
         $preguntasCorrectas++;
     }
   }
   $totalPreguntas=$preguntas->count();
   return compact( 'totalPreguntas' ,'preguntasCorrectas' );
  }

  public function calculaPorcentaje(){
      $resultado= $this->calcularCalificacion();
      return ($resultado['preguntasCorrectas'] /$resultado['totalPreguntas'])*100;
  }

}
