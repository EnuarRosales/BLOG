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
            $table->float('Cantidad', 12, 2);
            $table->float('TRM', 12, 2)->nullable();

            $table->float('valorPagina', 12, 2)->nullable();
            $table->float('dolares', 12, 2)->nullable();
            $table->float('pesos', 12, 2)->nullable();
            $table->float('porcentaje', 12, 2)->nullable();
            $table->float('netoPesos', 12, 2)->nullable();
            $table->float('porcentajeTotal', 12, 2)->nullable();
            $table->boolean('verificado')->default(false)->nullable();
            $table->boolean('enviarPago')->default(false)->nullable();

            $table->float('metaModelo', 12, 2)->nullable();//NEW
            

            $table->unsignedBigInteger('user_id'); //campo para relacion   
            $table->unsignedBigInteger('pagina_id'); //campo para relacion 
            // $table->unsignedBigInteger('metaModelo_id')->nullable(); //campo para relacion    

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('pagina_id')
                ->references('id')->on('paginas')
                ->onDelete('cascade');

            // $table->foreign('metaModelo_id')
            //     ->references('id')->on('meta_modelos')
            //     ->onDelete('cascade');


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
        Schema::dropIfExists('reporte_paginas');
    }
};
