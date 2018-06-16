<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Representant extends Model
{
    public $tables="representants";



    public function contract(){
      return $this->belongsTo("App\Model\Contract","id_contract");
    }
    public function adress(){
      return $this->hasMany("App\Model\AdressRepresentant","id_representant");
    }


}
