<?php
/**
 * Created by PhpStorm.
 * User: fercho14.93
 * Date: 12/05/18
 * Time: 16:06
 */

namespace App\Model;

use \Illuminate\Database\Eloquent\Model;


 class Tickets extends Model{

    const TYPE_ACTIVE_USER = 'ACTIVE_USER';
    const TYPE_FORGET_PASSWORD_USER = 'FORGET_USER';


    public $timestamps=false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type','date_created','date_expired','token','entity_id'
    ];




     public static function getExpirationDate($days = 1) {
         $expired  = new \DateTime();
         try {
             $expired->add(new \DateInterval('P' . $days . 'D'));
         } catch (\Exception $e) {
         }
         return $expired;

     }


     public static function createToken($type,$entity_id , $extra=''){

        /* Eliminamos token anteriores  */

        $tikets= Tickets::where( compact($type,$entity_id) )->get();

        if(  $tikets !=null   ){
            foreach (  $tikets as $tiket  ){
                $tiket->delete();
            }

        }
        $token =self::generateKeySecurity(true,$extra);
        $data = [
          'type' => $type,
          'entity_id' =>$entity_id,
            'date_created' => new \DateTime(),
            'date_expired' => self::getExpirationDate(),
           'token' => $token
        ];

        self::create(  $data );

        return $data['token'];

    }

    /**
     * Funcion necesaria para generar un token de seguridad
     */

    protected static function generateKeySecurity( $unique=true, $extra='' ){

        $keySecurity =   hash("sha512",random_bytes(5) . $extra);
        if( $unique &&  self::where( 'token' ,  $keySecurity ) ->exists()  ){
            $keySecurity= self::generateKeySecurity(   $unique,$extra);
        }
        return $keySecurity;
    }



}