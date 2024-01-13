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
        Schema::table('reporte_paginas', function (Blueprint $table) {
            // Agregar nuevas columnas
            $table->string('operacion')->nullable();
            $table->float('porcentaje_add', 12, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reporte_paginas', function (Blueprint $table) {
            // Eliminar las columnas en el rollback
            $table->dropColumn('operacion');
            $table->dropColumn('porcentaje_add');
        });
    }
};
