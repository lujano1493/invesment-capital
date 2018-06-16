<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressRepresentantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_representants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("id_contract");
            $table->unsignedInteger("id_representant");
            $table->string("cp",10);
            $table->string("street",150);
            $table->string("noExt",30)->nullable();
            $table->string("noInt",30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_representants');
    }
}
