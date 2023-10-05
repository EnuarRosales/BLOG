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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->boolean('pagado')->default(false)->nullable();
            $table->float('devengado', 12, 2)->nullable();
            $table->float('descuento', 12, 2)->nullable();
            $table->float('neto', 12, 2)->nullable();
            $table->float('impuestoPorcentaje', 12, 2)->nullable();
            $table->float('impuestoDescuento', 12, 2)->nullable();
            $table->float('multaDescuento', 12, 2)->nullable();
            // $table->unsignedBigInteger('descuento_id')->nullable(); //campo para relacion 
            $table->unsignedBigInteger('user_id')->nullable(); //campo para relacion  
            $table->unsignedBigInteger('impuesto_id')->nullable(); //campo para relacion  

            // $table->foreign('descuento_id')
            //     ->references('id')->on('descuentos')
            //     ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('impuesto_id')
                ->references('id')->on('impuestos')
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
        Schema::dropIfExists('pagos');
    }
};
