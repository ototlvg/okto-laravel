<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('matricula')->unique();
            $table->string('semestre');
            $table->integer('grupo')->nullable();
            // $table->string('email')->unique()->nullable(); /// Nuevo
            $table->string('email')->nullable(); /// Nuevo

            $table->unsignedBigInteger('carrera');
            $table->foreign('carrera')->references('carrera')->on('carreras')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_profile', function (Blueprint $table) {
            //
        });
    }
}
