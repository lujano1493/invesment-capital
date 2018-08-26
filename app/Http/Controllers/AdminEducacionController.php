<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CuestionarioController;
use App\Model\User;
use App\Model\Cuestionario;
use App\Model\CuestionarioPreguntas;
use App\Model\CuestionarioPreguntasOpciones;

class AdminEducacionController extends Controller
{
  use CuestionarioController;

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('auth.admin');
  }



}
