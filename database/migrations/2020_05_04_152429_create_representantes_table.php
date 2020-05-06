<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("id_persona");
            $table->unsignedBigInteger("id_telefono");
            $table->unsignedBigInteger("id_users");
            $table->foreign("id_persona")
                  ->references('id')->on('personas')
                  ->onDelete('cascade');
            $table->foreign("id_telefono")
                  ->references('id')->on('telefonos')
                  ->onDelete('cascade');
            $table->foreign("id_users")
                  ->references('id')->on('users');
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
        Schema::dropIfExists('representantes');
    }
}
