<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AddressRepresentant extends Model
{
    public $table="address_representants";
    public $timestamps = false;

    protected $fillable = [
        'id_contract', 'cp','street','noExt','noInt'
    ];



    public function representant(){
        return $this->belongsTo("App\Model\Representant","id_representant");
    }
}
