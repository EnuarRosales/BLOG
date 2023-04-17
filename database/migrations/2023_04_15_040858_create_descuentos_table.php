<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descuentos', function (Blueprint $table) {
            $table->id();           
            $table->timestamp('fecha');
            $table->float('montoDescuento');
            $table->float('montoDescontado');
            $table->float('saldo');
            $table->unsignedBigInteger('tipoDescuento_id');//campo para relacion 
            $table->unsignedBigInteger('user_id');//campo para relacion                       
            
            $table->foreign('tipoDescuento_id')
                    ->references('id')->on('tipo_descuentos')//tabla
                    ->onDelete('cascade');         

            $table->foreign('user_id')
                    ->references('id')->on('users')
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
        Schema::dropIfExists('descuentos');
    }
}
