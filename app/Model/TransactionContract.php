<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TransactionContract extends Model
{
    public $table="transactions_contract";
    public $timestamps = false;
    protected $fillable = [
      'id_contract', 'id_type_transaction','id_status_transaction','amount','id_origin'
    ];


    public function status(){
        return $this->belongsTo("App\Model\StatusTransaction" ,"id_status_transaction" );
    }
    public function origin(){
      return $this->belongsTo("App\Model\OriginTransaction" ,"id_origin_transaction" );
    }
    public function type(){
      return $this->belongsTo("App\Model\TypeTransaction" ,"id_type_transaction" );
    }
}
