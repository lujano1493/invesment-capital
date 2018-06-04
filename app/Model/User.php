<?php

namespace App\Model;

use App\Model\Search\FullTextSearch;
use App\Notifications\ActiveUserNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\RestorePasswordUserNotification;
use Illuminate\Support\Facades\Event;
use Collective\Html\Eloquent\FormAccessible;
use Kyslik\ColumnSortable\Sortable;


class User extends Authenticatable
{
    use Notifiable;
    use FormAccessible;
    use FullTextSearch;
    use Sortable;

    const STATUS_BLOCKED = -1;
    const STATUS_INACTIVE= 0;
    const STATUS_ACTIVE = 1;
    const ROLE_ADMIN =1;
    const ROLE_USER=2;


    protected $searchable = [
          'nickname','name','last_name','last_second_name','email'
      ];


      public $sortable = [
        'id',  'nickname','name','last_name','last_second_name','email', 'status','birth_date'
      ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','nickname','last_name','last_second_name','birth_date' ,'email', 'password','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     protected $dates = [
        'created_at',
        'updated_at',
        'birth_date'
    ];


     private $passwordPlain;



     public function isAdmin(){
       return $this->role_id ===  User::ROLE_ADMIN;

     }
     public function role(){
            return $this->belongsTo("App\Model\Roles","role_id" );
     }


     public function modules(){
        return $this->belongsToMany("App\Model\Modules", "access", "id_user","id_module")
               ->as('access')->withPivot('date_expired','id') ;
    //->using("App\Model\Access")
     }



    public function formBirthDateAttribute($value){

        return $value->format('Y-m-d');
    }


    public function getPasswordPlain(){
        return $this->passwordPlain;
    }

    public function setPasswordPlain($passwordPlan=''){
        $this->passwordPlain =$passwordPlan;
    }


    public function sendActiveUserNofication(){
        $token = Tickets::createToken(Tickets::TYPE_ACTIVE_USER,$this->id, $this->email  );
        $data=[
            'token' =>$token,
            'name' => $this->name,
            'email' => $this->email,
            'last_name' =>$this->last_name,
            'nickname' =>$this->nickname,
            'password' =>$this->passwordPlain
        ];

        $this->notify(new ActiveUserNotification($data));
    }

    public function sendNotificationRestorePassword($data){
        $this->notify(new RestorePasswordUserNotification(($data)));

    }

    public function encryptPassword(){
        $this->passwordPlain =$this ->password;
        $this->password = bcrypt($this->password);
    }


    public static function generatePassword(){
        return "12345678";
    }
    public  function updatePasswordSendActivation(){
        $this->password=  User:: generatePassword();
        $this->encryptPassword();
        if ( ! $this->save()  ){
            return false;
        }
        $this->sendActiveUserNofication();
        return true;
    }


    protected static function  boot(){
        parent::boot();

        static::creating(function ($user){
            Event::fire("user.creating",$user);
        });

        static::updating(function ( $user){
        });


        static::created(function ($user)  {
           $user->sendActiveUserNofication();
        });

    }

}
