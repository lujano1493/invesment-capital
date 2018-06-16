<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_contract', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("id_contract");
            $table->string("name");
            $table->binary('content');
            $table->smallInteger('id_type_document');
            $table->smallInteger("id_extension");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_contract');
    }
}
