<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    	$users = User::paginate(25);
        return  view('admin_home',compact('users'));
    }

    public function register_user(){


    	return view('admin.register_user');
    }
}
