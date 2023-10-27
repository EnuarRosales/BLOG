<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionMultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_multas', function (Blueprint $table) {
            $table->id();
            $table->boolean('descontado')->default(false)->nullable();
            $table->date('fechaDescontado')->nullable();


            $table->unsignedBigInteger('user_id'); //campo para relacion
            $table->unsignedBigInteger('tipoMulta_id'); //campo para relacion

            $table->foreign('user_id')
                ->references('id')->on('users') //tabla
                ->onDelete('cascade');
            $table->foreign('tipoMulta_id')
                ->references('id')->on('tipo_multas');


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
        Schema::dropIfExists('asignacion_multas');
    }
}
