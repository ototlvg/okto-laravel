<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->longText('tema');	
            $table->longText('descripcion');	

            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');

            $table->unsignedBigInteger('profesor_id');
            $table->foreign('profesor_id')->references('id')->on('profesores')->onDelete('cascade');

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
        Schema::dropIfExists('posts');
    }
}
