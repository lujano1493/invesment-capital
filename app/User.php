<?php

namespace App;

use App\Model\Tickets;
use App\Notifications\ActiveUserNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\RestorePasswordUserNotification;
use Illuminate\Support\Facades\Event;

class User extends Authenticatable
{
    use Notifiable;

    const STATUS_INACTIVE= 0;
    const STATUS_ACTIVE = 1;
    const ROLE_ADMIN =0;

    const ROLE_USER=1;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','nickname','last_name','last_second_name','birth_date' ,'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];





    public function sendActiveUserNofication(){
        $token = Tickets::createToken(Tickets::TYPE_ACTIVE_USER,$this->id, $this->email  );
        $data=[
            'token' =>$token,
            'name' => $this->name,
            'last_name' =>$this->last_name,
            'nickname' =>$this->nickname
        ];

        $this->notify(new ActiveUserNotification($data));
    }

    public function sendNotificationRestorePassword($data){
        $this->notify(new RestorePasswordUserNotification(($data)));

    }


    protected static function  boot(){
        parent::boot();

        static::creating(function ($user){
            Event::fire("user.creating",$user);
        });
        static::created(function ($user)  {
           $user->sendActiveUserNofication();
        });

    }

}
