<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function test(Request $request){
        
        if( $request->exists('opc') ){

           // $request->session()->flash('prueba','mensaje');
          //   $request->session()->flash('message-result',[  'status' =>  'error' ,'message' =>'prueba' ]);
            return  $this->alertWarning('prueba','test');
        }


        return view('test');
    }
}
