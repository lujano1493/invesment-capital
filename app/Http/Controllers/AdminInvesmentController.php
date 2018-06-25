<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;

class AdminInvesmentController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('auth.admin');
  }
  
    public function inicio(Request $request){
    	$query = $request->get("query_search");

    	$users = User::search($query)->sortable()->where( "id_role" ,"!=",User::ROLE_ADMIN  ) ->paginate(10);
      	$request->flashOnly(["query_search"]);
    	return view("admin.invesment",compact('users'));
    }

    public function edit(Request $request, $id  ){

    		return $id;

    }


}
