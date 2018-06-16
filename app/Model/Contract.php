<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public $table ='contracts';


    public function user(){
      return $this->belongsTo("App\Model\User","id_user" );
    }

    public function representants(){
      return $this->hasMany("App\Model\Representant","id_contract");
    }
}
