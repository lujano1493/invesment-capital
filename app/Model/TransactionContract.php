<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TransactionContract extends Model
{
    public $table="transactions_contract";
    public function status(){
        return $this->belongsTo("App\Model\StatusTransaction" ,"id_status_transaction" );
    }
    public origin(){
      return $this->belongsTo("App\Model\OriginTransaction" ,"id_origin_transaction" );
    }
    public type(){
      return $this->belongsTo("App\Model\TypeTransaction" ,"id_type_transaction" );
    }
}
