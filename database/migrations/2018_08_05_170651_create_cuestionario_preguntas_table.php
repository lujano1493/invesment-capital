<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuestionarioPreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuestionario_preguntas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_cuestionario");
            $table->integer("secuencia");
            $table->smallInteger("tipo");
            $table->longText("pregunta", 1024);
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
        Schema::dropIfExists('cuestionario_preguntas');
    }
}
