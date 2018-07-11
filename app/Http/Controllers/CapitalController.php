<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\User\UserProfileController;

use App\Model\ProfileInvesment;
use App\Model\HorizonInvesment;
use App\Model\TypeObjective;
use App\Model\Bank;
use App\Model\TypeRepresentant;
use App\Model\ClasifCountBank;
use App\Model\AddressRepresentant;
use App\Model\CountBankRepresentant;
use App\Model\TypeDocument;
use App\Model\ExtensionDocument;
use App\Model\DocumentContract;
use App\Model\TransactionContract;
use App\Model\OriginTransaction;
use App\Model\StatusTransaction;
use App\Model\TypeTransaction;

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

      $catProfile= ProfileInvesment::pluck('name','id')->all();
      $catHorizon=HorizonInvesment::pluck('name','id')->all();
      $catTypeObjective=TypeObjective::pluck('name','id')->all();
      $catTypeReprensentant= TypeRepresentant::pluck('name','id')->all();
      $catBancks= Bank::pluck('name','id')->all();
      $catClasifCountBanck=ClasifCountBank::pluck('name','id') ->all();
      $catTypeDocument = TypeDocument::pluck('name','id')->all();
      $catOriginTrans= OriginTransaction::pluck('name','id')->all();
      $catTypeTrans=TypeTransaction::pluck('name','id') ->all();
      $catStatusTrans = StatusTransaction::pluck('name','id')->all();

        return view('capital.invesment_index',
              compact('user','catProfile','catHorizon','catTypeObjective',
                  'catTypeReprensentant' ,'catBancks','catClasifCountBanck',
                  'catTypeDocument','catOriginTrans','catTypeTrans','catStatusTrans'));
    }


     public function educacion()
    {
        return view('capital.educacion_index');
    }



}
