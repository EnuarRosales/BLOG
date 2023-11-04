<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaTiempoConfigTable extends Migration
{
    public function up()
    {
        Schema::create('asistencia_tiempo_configs', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('clase');
            $table->integer('tiempo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asistencia_tiempo_configs');
    }
}
