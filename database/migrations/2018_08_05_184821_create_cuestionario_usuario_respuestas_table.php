<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuestionarioUsuarioRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuestionario_usuario_respuestas', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_asignacion');
          $table->integer("id_user");
          $table->integer("id_cuestionario");
          $table->integer("id_pregunta");
          $table->integer("id_opcion");
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
        Schema::dropIfExists('cuestionario_usuario_respuestas');
    }
}
