<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AddressRepresentant extends Model
{
    public $table="address_representants";


    public function representant(){
        return $this->belongsTo("App\Model\Representant","id_representant");
    }
}
