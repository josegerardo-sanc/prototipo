<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradasUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("fecha_entrada",50);
            $table->string("hora_entrada",50);
            $table->string("fecha_salida",50)->nullable();            
            $table->string("hora_salida",50)->nullable();            
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('entradas_users');
    }
}
