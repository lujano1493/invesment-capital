<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Representant extends Model
{
    public $tables="representants";
    public $timestamps = false;

    protected $fillable = [
          'id_type_representant','name','last_name','last_second_name','birth_date','rfc'
    ];


    public function typeRepresent(){
      return $this->belongsTo("App\Model\TypeRepresentant" ,"id_type_representant" );
    }

    public function contract(){
      return $this->belongsTo("App\Model\Contract","id_contract");
    }
    public function address(){
      return $this->hasMany("App\Model\AddressRepresentant","id_representant");
    }

    public function count_banks(){
      return $this->hasMany("App\Model\CountBankRepresentant","id_representant");
    }


}
