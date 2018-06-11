<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StatusUser extends Model
{

	public $table="status_user";
    public $timestamps=false;
    protected $fillable=[ "name" ];

}