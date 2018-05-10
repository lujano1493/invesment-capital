<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname',100);
            $table->string('name',128);
            $table->string('last_name',128);
            $table->string('last_second_name',128)->nullable(true);
            $table->date('birth_date')->nullable(true);
            $table->string('email',255)->unique();
            $table->string('password',255);
            $table->smallInteger('status');
            $table->smallInteger('role_id');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
