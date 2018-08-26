<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CuestionarioUsuarioRespuesta extends Model
{

  protected $fillable = [
      'id_cuestionario','id_pregunta','id_asignacion','id_opcion','id_user'
  ];
  protected $dates = [
      'created_at',
      'updated_at'
  ];
  public function asignacion(){
    return $this->belongsTo("App\Model\AsignacionCuestionario","id_asignacion");
  }


  public function opcion(){
    return $this->belongsTo("App\Model\CuestionarioPreguntasOpciones","id_asignacion");
  }
}
