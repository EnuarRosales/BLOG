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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');                        
            $table->rememberToken(); 

            $table->unsignedBigInteger('tipoUsuario_id');//campo para relacion 
            $table->foreign('tipoUsuario_id')->nullable()
                    ->references('id')->on('tipo_usuarios')//tabla
                    ->onDelete('cascade');    
            $table->timestamps();
            //$table->unsignedBigInteger('tipoUsuario_id');
            /* //relaciones de uno a muchos
           $table->foreign('tipoUsuario_id')            
             ->references('id')->on('tipo_usuarios')
             ->onDelete('cascade');*/
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

