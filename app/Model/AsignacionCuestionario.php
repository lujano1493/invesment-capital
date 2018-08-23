<?php

namespace App\Model;

use \Illuminate\Database\Eloquent\Relations\Pivot;
use Collective\Html\Eloquent\FormAccessible;

class AsignacionCuestionario extends Pivot
{
  use FormAccessible;

  protected $dates = [
      'created_at',
      'updated_at',
      'fecha_finalizado'
  ];

  public function formFechaFinalizadoAttribute($value){
      return $value->format('Y-m-d');
  }


}
