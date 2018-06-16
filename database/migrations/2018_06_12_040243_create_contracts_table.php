<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('id_user');
          $table->string("desc")->nullable(true);
          $table->smallInteger("id_profile_invesment");
          $table->smallInteger("id_horizon_invesment");
          $table->smallInteger("id_type_objective");
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
        Schema::dropIfExists('contracts');
    }
}
