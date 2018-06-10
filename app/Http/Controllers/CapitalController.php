<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CapitalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('capital.index');
    }


    public function invesment()
    {
        return view('capital.invesment_index');
    }


     public function educacion()
    {
        return view('capital.educacion_index');
    }


      public function profile()
    {
        $catEstatus= [
            -1 => "Bloqueada",
            0 => "Inactiva",
            1 => "Activa"
        ];
        return view('capital.perfil_index',compact('catEstatus'));
    }

   
}
