<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminInvesmentController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('auth.admin');
  }
  
    public function inicio(){
    	return view("admin.invesment");

    }


}
