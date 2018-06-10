<?php
namespace App\Model;
use \Illuminate\Database\Eloquent\Relations\Pivot;
use Collective\Html\Eloquent\FormAccessible;


    class Access extends Pivot{

    	use FormAccessible;

        public $table ="access";
        public $timestamps=false;
        public $fillable = ["id_user","id_module","date_expired" ];

        protected $dates = [
        'date_expired'
	    ];

	    public function formDateExpiredAttribute($value){
        	return $value->format('Y-m-d');
    	}

    }