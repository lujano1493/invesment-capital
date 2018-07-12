<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserInvestmentController;

class CapitalController extends Controller
{

    use UserProfileController;
    use UserInvestmentController;
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




     public function educacion()
    {
        return view('capital.educacion_index');
    }





}
