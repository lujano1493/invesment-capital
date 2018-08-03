<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
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


    public function status(){
      return $this->belongsTo("App\Model\StatusBalance","id_status_balance" );
    }
}
