<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminEducacionController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('auth.admin');
  }
  
    public function inicio(){

    	return  view("admin.educacion");
    }
}
