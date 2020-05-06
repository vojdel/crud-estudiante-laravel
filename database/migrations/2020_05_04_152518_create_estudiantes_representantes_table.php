<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesRepresentantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes_representates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_estudiante');
            $table->unsignedBigInteger('id_representante');
            $table->foreign('id_estudiante')->references('id')->on('estudiantes');
            $table->foreign('id')->references('id')->on('representantes');
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
        Schema::dropIfExists('estudiantes_representates');
    }
}
