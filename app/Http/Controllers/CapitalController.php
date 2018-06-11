<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\User\UserProfileController;

class CapitalController extends Controller
{

    use UserProfileController;
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


   
}
