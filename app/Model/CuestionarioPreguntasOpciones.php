<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CuestionarioPreguntasOpciones extends Model
{
  protected $fillable = [
    'id_cuestionario', 'id_pregunta',  'enciso','valor'
  ];
}
