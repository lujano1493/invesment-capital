<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepresentantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representants',function (Blueprint $table){
          $table->increments("id");
          $table->unsignedInteger("id_contract");
          $table->smallInteger("id_type_representant");
          $table->string("name",150);
          $table->string("last_name",150);
          $table->string("last_second_name",150) ->nullable(true);
          $table->date('birth_date')->nullable(true);
          $table->string("rfc",20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representants');
    }
}
