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
        Schema::create('descontados', function (Blueprint $table) {
            $table->id();
            $table->double('valor')->nullable();
            $table->string('descripcion',150)->nullable();
            $table->unsignedBigInteger('descuento_id');//campo para relacion
            $table->timestamps();

            $table->foreign('descuento_id')
                    ->references('id')->on('descuentos')//tabla
                    ->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('descontados');
    }
};
