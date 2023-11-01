<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_turnos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); //campo para relacion
            $table->unsignedBigInteger('turno_id'); //campo para relacion
            $table->foreign('user_id')
                ->references('id')->on('users') //tabla
                ->onDelete('cascade');
            $table->foreign('turno_id')
                ->references('id')->on('turnos');
            $table->timestamps();
            $table->softDeletes(); // Agregar esta línea para habilitar eliminación suave

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignacion_turnos');
    }
}
