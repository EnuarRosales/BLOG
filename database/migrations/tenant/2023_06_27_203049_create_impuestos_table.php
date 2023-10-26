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
        Schema::create('impuestos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100)->nullable();
            $table->float('porcentaje', 12, 2)->nullable();
            $table->float('mayorQue', 12, 2)->nullable();
            $table->boolean('estado')->default(false)->nullable();
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
        Schema::dropIfExists('impuestos');
    }
};
