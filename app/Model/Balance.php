<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Facades\DB;

class Balance extends Model
{

    use FormAccessible;

    public $table="balances";

    protected $fillable = [
        'id_contract','payments','withdrawals','change','balance','balance_total','renta_variable','deuda','id_status_balance'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

     protected $casts = [
        'payments' => 'float',
        'withdrawals' =>'float',
        'change' =>'float',
        'balance' =>'float',
        'balance_total' => 'float',
        'renta_variable' =>'float',
        'deuda' =>'float'
    ];


    public  static function updateCalculo($idContrato){


      $balance= Balance::where('id_contract' , $idContrato )->orderBy('id','desc')->first();

      if ( $balance == null  ){
        return null;
      }


      $despositos=TransactionContract::where(
          [ 'id_contract' => $idContrato  ,
            'id_type_transaction' => 1,
            'id_status_transaction' => 2])->sum('amount');

      $retiros=TransactionContract::where(
          [ 'id_contract' => $idContrato ,
            'id_type_transaction' => 2,
            'id_status_transaction' => 2 ])->sum('amount');


      $saldoBase = $despositos-$retiros;
      $porcentaje = $balance->change /100;
      $saldoTotal =   $saldoBase * $porcentaje;
      $data = [
            'payments' => $despositos,
            'withdrawals' => $retiros,
            'balance' => $saldoBase,
            'balance_total' => $saldoTotal
        ] ;
      $balance->fill( $data);
      $balance->save();
      return $balance;

    }


    public function status(){
      return $this->belongsTo("App\Model\StatusBalance","id_status_balance" );
    }

    public function getCreacionAttribute(){
      return $this->created_at->format('d-m-Y h:i:s A');
    }

    public function formCreatedAtAttribute($value){

        return $value->format('d-m-Y h:i:s A');
    }

    public function formUpdatedAtAttribute($value){

        return $value->format('d-m-Y h:i:s A');
    }

}
