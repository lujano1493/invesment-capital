<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CuestionarioPreguntasOpciones extends Model
{
  protected $fillable = [
    'id_cuestionario', 'id_pregunta',  'enciso','valor','es_correcto'
  ];


  protected $visible=['id','id_cuestionario','id_pregunta'];

  public function pregunta(){
    return $this->belongsTo("App\Model\CuestionarioPreguntas","id_pregunta");
  }


}
