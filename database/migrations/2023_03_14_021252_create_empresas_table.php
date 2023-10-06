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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('nit')->nullable();
            $table->string('address')->nullable();
            $table->string('representative')->nullable();
            $table->string('representative_identification_card')->nullable();
            $table->integer('number_rooms')->nullable();
            $table->integer('capacity_models')->nullable();
            $table->string('logo')->nullable();

           
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
        Schema::dropIfExists('empresas');
    }
};
