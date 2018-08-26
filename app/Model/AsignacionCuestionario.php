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

}
