<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_rooms', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha');

            $table->unsignedBigInteger('user_id');//campo para relacion 
            $table->unsignedBigInteger('room_id');//campo para relacion 

            $table->foreign('user_id')
                    ->references('id')->on('users')//tabla
                    ->onDelete('cascade');

            $table->foreign('room_id')
                    ->references('id')->on('rooms')
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
        Schema::dropIfExists('asignacion_rooms');
    }
}
