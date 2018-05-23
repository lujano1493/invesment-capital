<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminEducacionController extends Controller
{
    public function inicio(){

    	return  view("admin.educacion");
    }
}
