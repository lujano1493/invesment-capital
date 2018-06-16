<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountBankRepresentantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('count_bank_representants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("id_contract");
            $table->unsignedInteger('id_representant');
            $table->smallInteger('id_bank');
            $table->string("number_count",150);
            $table->string("clabe",150);
            $table->smallInteger("type_clasif");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('count_bank_representants');
    }
}
