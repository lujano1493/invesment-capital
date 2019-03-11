<?php

namespace App\Http\Controllers\User;

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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait UserInvestmentController{


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
            compact('catProfile','catHorizon','catTypeObjective',
                'catTypeReprensentant' ,'catBancks','catClasifCountBanck',
                'catTypeDocument','catOriginTrans','catTypeTrans','catStatusTrans'));
  }

  public function viewDocument($id){
      if($id == null){
        return $this->alertError("No existe el documento.","capital.invesment");
      }
      $user= Auth::user();
      $documento= DocumentContract::where( "id", $id )->first( ["id", "id_contract" ] );
      if($documento== null){
        return $this->alertError("Documento no encontrado.","admin.users");
      }

      $contracto = $documento->contract;
      if( $user->id  !=   $contracto->id_user){
          return $this->alertError("Documento no encontrado.","admin.users");
      }
      $documento = DocumentContract::find($id);


    //  $file_contents = base64_decode($documento->content);
      return response($documento->content)
          ->header('Cache-Control', 'no-cache private')
          ->header('Content-Description', 'File Viewer')
          ->header('Content-Type', $documento->extension->name)
          ->header('Content-length', strlen($documento->content))
          ->header('Content-Disposition' , 'inline; filename="'.$documento->name.'"');
  }

  public function downloadDocument($id){
    if($id == null){
      return $this->alertError("No existe el documento.","capital.invesment");
    }
    $user= Auth::user();
    $documento= DocumentContract::where( "id", $id )->first( ["id", "id_contract" ] );
    if($documento== null){
      return $this->alertError("Documento no encontrado.","admin.users");
    }

    $contracto = $documento->contract;
    if( $user->id  !=   $contracto->id_user){
        return $this->alertError("Documento no encontrado.","admin.users");
    }
    $documento = DocumentContract::find($id);
    return response($documento->content)
          ->header('Cache-Control', 'no-cache private')
          ->header('Content-Description', 'File Viewer')
          ->header('Content-Type', $documento->extension->name)
          ->header('Content-length', strlen($documento->content))
          ->header('Content-Disposition', 'attachment; filename=' . $documento->name)
          ->header('Content-Transfer-Encoding', 'binary');
  }



  public function retirar(Request $request){

    $user = Auth::user();
    $contrato = $user->contract;
    if( !isset($contrato) ){
        return $this->alertError("Aun no tienes configurado un contrato.");
    }

    $montoRetiro = $request->get("retirar");

    if(!is_numeric($montoRetiro)){
        return $this->alertError("Debes ingresar un monto valido");
    }

    $montoRetiro= floatval($montoRetiro );

    if( $montoRetiro <= 0.0){
        return $this->alertError("Debes ingresar un monto mayor a cero");
    }

    $totalDeposito= $contrato->transactions()
 			->where(['id_status_transaction'  =>2 ,'id_type_transaction' => 1 ])
 			->sum("amount");

    $totalDeposito=floatval($totalDeposito);


    if( $montoRetiro > $totalDeposito   ){
        return $this->alertError("El monto a retirar es mayor al que se tiene.");
    }


  //  $fieldDate=DB::raw("DATE(created_at)='". date('Y-m-d') ."'");


    $masRetiros = $contrato->transactions()
      ->where('id_type_transaction' , 2  )
      ->where('id_status_transaction',1)
      ->whereDate(  'created_at','=', date('Y-m-d') )->get();

    if( $masRetiros->isNotEmpty()){
        return $this->alertWarning("Existe una petición de retiro en proceso.");
    }
     $transactionContract= new TransactionContract([
      'id_type_transaction' => 2,
      'id_status_transaction' => 1,
      'amount' => $montoRetiro,
      'id_origin' => 2 , //Revisar si sera transferencia bancaria
      ]
    );
    $transaccion = $contrato->transactions()->save($transactionContract) ;
    if( $transaccion ){
      $transaccion->notifyTransaction();
      return $this->alertSuccess("La petición de retiro fue enviada correctamente.");
    }
    return $this->alertError("No fue posible realizar petición de retiro.");

  }



}


 ?>
