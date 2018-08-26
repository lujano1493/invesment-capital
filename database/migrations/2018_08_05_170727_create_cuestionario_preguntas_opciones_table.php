<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuestionarioPreguntasOpcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuestionario_preguntas_opciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_cuestionario");
            $table->integer("id_pregunta");
            $table->string("enciso",50);
            $table->boolean("es_correcto")->default(false);
            $table->string("valor",3024);
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
        Schema::dropIfExists('cuestionario_preguntas_opciones');
    }
}
