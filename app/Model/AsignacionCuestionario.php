<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AsignacionCuestionario extends Model
{
  protected $dates = [
      'created_at',
      'updated_at',
      'fecha_limite'
  ];

}
