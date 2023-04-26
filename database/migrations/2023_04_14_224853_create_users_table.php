<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',45);
            $table->string('cedula',45);
            $table->string('celular',45);
            $table->string('direccion',45);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            


            $table->unsignedBigInteger('tipoUsuario_id'); //campo para relacion 
            $table->foreign('tipoUsuario_id')->nullable()
                ->references('id')->on('tipo_usuarios') //tabla
                ->onDelete('cascade');
                

            $table->timestamps();
            $table->string('password')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
