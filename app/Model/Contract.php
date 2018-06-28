<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public $table ='contracts';


    protected $fillable = [
        'id_profile_invesment','id_horizon_invesment','id_type_objective'
    ];


    public function user(){
      return $this->belongsTo("App\Model\User","id_user" );
    }

    public function representants(){
      return $this->hasMany("App\Model\Representant","id_contract");
    }
}
