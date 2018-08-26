<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CuestionarioPreguntas extends Model
{


    protected $fillable = [
        'secuencia','tipo','pregunta','puntaje'
    ];

    public function opciones(){
      return $this->hasMany("App\Model\CuestionarioPreguntasOpciones","id_pregunta");
    }
}
