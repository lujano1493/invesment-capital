<?php
/**
 * Created by PhpStorm.
 * User: fercho14.93
 * Date: 27/05/18
 * Time: 01:44
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{

    public $timestamps=false;

    protected $fillable=[ "name" ];

    public function users(){
      return $this->hasMany("App\Model\User", "id_role");
    }


}
