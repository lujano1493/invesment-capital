<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use App\Notifications\PeticionRetiroNotification;

class TransactionContract extends Model
{
    use Notifiable;
    public $table="transactions_contract";
    protected $fillable = [
      'id_contract', 'id_type_transaction','id_status_transaction','amount','id_origin'
    ];

    protected $casts = [
        'amount' => 'float',
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
    public function contract(){
      return $this->belongsTo("App\Model\Contract" ,"id_contract" );
    }


    public function notifyTransaction( ){
      $users = User::where([
          "id_role" => 1

        ] )->get();
      $contrato= $this->contract;
      $userContract= $contrato->user;
      foreach ($users as $user) {
          $data=[
            'nickname' => $user->nickname,
            'email' => $userContract->email,
            'idUser' => $userContract->id,
            'monto' => $this->amount
          ];
            $this->email = $user->email;
           $this->notify( new PeticionRetiroNotification($data) );

      }

    }

}
