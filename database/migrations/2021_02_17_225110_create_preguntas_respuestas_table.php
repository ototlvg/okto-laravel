<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntasRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas_respuestas', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('pregunta_id');
            $table->foreign('pregunta_id')->references('id')->on('preguntas')->onDelete('cascade');

            $table->unsignedBigInteger('respuesta_id');
            $table->foreign('respuesta_id')->references('id')->on('respuestas')->onDelete('cascade');

            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('iteration')->nullable();



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
        Schema::dropIfExists('preguntas_respuestas');
    }
}
