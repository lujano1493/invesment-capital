<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignacionCuestionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_cuestionarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_user");
            $table->integer("id_cuestionario");
            $table->boolean("visto")->default(false);
            $table->dateTime('fecha_limite')->nullable();
            $table->dateTime('fecha_finalizado')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignacion_cuestionarios');
    }
}
