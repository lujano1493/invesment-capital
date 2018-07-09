<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DocumentContract extends Model
{
    public $table="documents_contract";

    protected $fillable = [
        'id_contract'  ,'name','content','id_type_document','id_extension'
    ];


    public function type(){
      return $this->belongsTo("App\Model\TypeDocument", "id_type_document"  );
    }
    public function extension(){
      return $this->belongsTo("App\Model\ExtensionDocument","id_extension");
    }


}
