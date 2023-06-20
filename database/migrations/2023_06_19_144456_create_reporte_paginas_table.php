<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporte_paginas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->float('Cantidad');

            $table->unsignedBigInteger('user_id'); //campo para relacion   
            $table->unsignedBigInteger('pagina_id'); //campo para relacion   

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('pagina_id')
                ->references('id')->on('paginas')
                ->onDelete('cascade');



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
        Schema::dropIfExists('reporte_paginas');
    }
};
