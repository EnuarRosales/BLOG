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
            $table->string('name',45)->nullable();
            $table->string('cedula',45)->nullable();
            $table->string('celular',45)->nullable();
            $table->string('direccion',150)->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            


            $table->unsignedBigInteger('tipoUsuario_id')->nullable(); //campo para relacion 
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
