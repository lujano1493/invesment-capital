<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CountBankRepresentant extends Model
{
    public $table="count_bank_representants";

    public $timestamps = false;

    protected $fillable = [
          'id_contract','id_bank','number_count','clabe','type_clasif'
    ];


}
