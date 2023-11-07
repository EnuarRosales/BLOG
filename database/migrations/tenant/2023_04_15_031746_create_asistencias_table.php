<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('mi_hora');
            $table->unsignedBigInteger('user_id'); //campo para relacion
            $table->foreign('user_id')
                ->references('id')->on('users') //tabla
                ->onDelete('cascade');

            $table->string('control');
            $table->unsignedBigInteger('multa_id')->nullable();
            $table->foreign('multa_id')
                ->references('id')->on('asignacion_multas') //tabla
                ->onDelete('cascade');
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
        Schema::dropIfExists('asistencias');
    }
}
