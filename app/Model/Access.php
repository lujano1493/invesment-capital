
<?php

    namespace App\Model;

    use \Illuminate\Database\Eloquent\Relations\Pivot;


    class Access extends Pivot{

        public $table ="access";
        public $timestamps=false;
        public $fillable = ["id_user","id_module","date_expired" ];

    }