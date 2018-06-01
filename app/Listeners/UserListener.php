<?php
/**
 * Created by PhpStorm.
 * User: fercho14.93
 * Date: 12/05/18
 * Time: 17:08
 */

namespace App\Listeners;

use App\Model\User;


class UserListener
{
     public function creating($user){
         //Agregamos Valores por defecto
         $user->status=User::STATUS_INACTIVE;
         $user->role_id =User::ROLE_USER;
         $user ->keycode=  hash("sha512",random_bytes(5) . $user->nickname);
         $user->encryptPassword();
     }
}
