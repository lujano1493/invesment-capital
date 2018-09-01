<?php

namespace App\Model;

use \Illuminate\Database\Eloquent\Relations\Pivot;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CuestionarioAsignadoNotification;
use App\Notifications\CuestionarioFinalizacionNotification;


class AsignacionCuestionario extends Pivot
{
  use FormAccessible;
  use Notifiable;

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
  $preguntas=$cuestionario->preguntas;
   $preguntasCorrectas=0;
   foreach( $preguntas  as $pregunta  ){
     $opcionesCorrecta=0;
     $opcionesCorrectasSeleccionadas=0;
     $opciones =  $pregunta->opciones;
       foreach( $opciones as  $opcion ){
       $opcion->es_seleccionada= isset(  $respuestas[ $opcion->id ]   );
       if($opcion->es_correcto){
           $opcionesCorrecta++;
       }
       if($opcion->es_correcto && $opcion->es_seleccionada ) {
            $opcionesCorrectasSeleccionadas++;
       }
       if(!$opcion->es_correcto && $opcion->es_seleccionada ) {  /* Si es incorrecta restamos  */
            $opcionesCorrectasSeleccionadas--;
       }

     }
     if($opcionesCorrectasSeleccionadas == $opcionesCorrecta ){
         $preguntasCorrectas++;
     }
      $pregunta->es_correcta=  $opcionesCorrectasSeleccionadas==$opcionesCorrecta ? true:false   ;

   }
   $totalPreguntas=$preguntas->count();
   return compact( 'totalPreguntas' ,'preguntasCorrectas' );
  }

  public function calculaPorcentaje(){
      $resultado= $this->calcularCalificacion();
      return ($resultado['preguntasCorrectas'] /$resultado['totalPreguntas'])*100;
  }

  public function pasaCuestionario(){
      $porcentaje =$this->calculaPorcentaje();
      return  $porcentaje>=60;
  }


  public function notificarAsignacion(){
      $usuario=  $this->usuario;
      $cuestionario = $this->cuestionario;
      $this->email = $usuario->email;

      $data= [ 'nombre' => $usuario->fullName,
                'email' => $usuario->email,
                'nombre_encuesta' => $cuestionario->titulo,
                'id' => $this->id,
              ];
      $this->notify( new CuestionarioAsignadoNotification($data) );

  }

  public function notificarFinalizacion(){
      $usuario=  $this->usuario;
      $cuestionario = $this->cuestionario;

      $usersAdmin = User::where('id_role', User::ROLE_ADMIN)->get();

      foreach($usersAdmin as $admin){
        $this->email= $admin->email;
        $data=[
          'nombre' => $admin->fullName,
          'correo' => $usuario->email,
          'id' => $this->id
        ];
        $this->notify( new CuestionarioFinalizacionNotification($data) );

      }





  }


  protected static function  boot(){
      parent::boot();

      static::created(function ($asignacion){

          //Envio de notificacion cuando se le asigne al usuario
      });

      static::updated(function ( $asignacion){

          if(  $asignacion->fecha_finalizado &&  $asignacion->pasaCuestionario()){
              $asignacion->notificarFinalizacion();
          }


        //notificacion cuando se termine de manera satisfactoria
      });




  }

}
