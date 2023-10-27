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
        Schema::create('meta_modelos', function (Blueprint $table) {
            $table->id();
            $table->float('mayorQue', 12, 2);
            $table->float('porcentaje', 12, 2);
                  
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
        Schema::dropIfExists('meta_modelos');
    }
};
