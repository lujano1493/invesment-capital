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


        return view('capital.inicio');
    }


    public function invesment()
    {
        return view('capital.inicio');
    }


     public function educacion()
    {
        return view('capital.inicio');
    }


      public function profile()
    {
        return view('capital.inicio');
    }

   
}
