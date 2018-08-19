<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Collective\Html\Eloquent\FormAccessible;

use App\Notifications\PeticionRetiroNotification;
use App\Notifications\PeticionRetiroRealizadoNotification;

class TransactionContract extends Model
{
    use FormAccessible;
    use Notifiable;


    public const STATUS_PENDIENTE = 1;
    public const STATUS_REALIZADO= 2;
    public const TYPE_DEPOSITO =1;
    public const TYPE_RETIRO=2;


    public $table="transactions_contract";
    protected $fillable = [
      'id_contract', 'id_type_transaction','id_status_transaction','amount','id_origin'
    ];

    protected $dates = [
       'created_at',
       'updated_at'
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


    public function formCreatedAtAttribute($value){

        return $value->format('d-m-Y h:i:s A');
    }

    public function formUpdatedAtAttribute($value){

        return $value->format('d-m-Y h:i:s A');
    }



    public function __notifyAdmin($userContract){
      $users = User::where([
          "id_role" => 1

        ] )->get();
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

    public function __notifyUser($userContract){
      $this->email = $userContract->email;
      $data= [
          'name' => $userContract->fullName,
          'monto' => $this->amount
      ];
       $this->notify( new PeticionRetiroRealizadoNotification($data) );

    }
    public function notifyTransaction( $pendiente=true  ){
      $contrato= $this->contract;
      $userContract= $contrato->user;
      if( $pendiente  ){
        $this->__notifyAdmin($userContract);
      }
      else {
        $this->__notifyUser($userContract);
      }
    }

}
