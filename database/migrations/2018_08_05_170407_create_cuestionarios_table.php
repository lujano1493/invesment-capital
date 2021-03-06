<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuestionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuestionarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string("titulo",512);
            $table->longText("descripcion");
            $table->date("fecha_limite");
            $table->boolean("mostrar_resultados")->default(1);
            $table->smallInteger("tipo");
            $table->timestamps();
        });
        DB::statement("ALTER TABLE cuestionarios ADD FULLTEXT Full_Text_Cuestionario (titulo, descripcion)" );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE cuestionarios DROP INDEX Full_Text_Cuestionario" );
        Schema::dropIfExists('cuestionarios');
    }
}
