<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Search\FullTextSearch;
use Kyslik\ColumnSortable\Sortable;

class Cuestionario extends Model
{

  use FullTextSearch;
  use Sortable;

  protected $dates = [
      'created_at',
      'updated_at',
      'fecha_limite'
  ];


    protected $searchable = [
        'titulo','descripcion'
    ];

    public $sortable = [
      'id',  'titulo','fecha_limite','updated_at'
    ];

    protected $fillable = [
        'tipo','titulo','fecha_limite','descripcion'
    ];


public function preguntas(){
  return $this->hasMany("App\Model\CuestionarioPreguntas","id_cuestionario");
}

public function usuarios(){
  return $this->belongsToMany("App\Model\User","asignacion_cuestionarios","id_cuestionario","id_user")
      ->using("App\Model\AsignacionCuestionario")->as("asignacion");
}


}
