<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResgistroProducidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resgistro_producidos', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha');
            $table->float('valorProducido');
            $table->string('alarma',45)->nullable();
            $table->string('cumplio',45)->nullable();
            $table->float('saldo')->nullable();
            $table->unsignedBigInteger('meta_id');//campo para relacion
            $table->unsignedBigInteger('pagina_id');//campo para relacion 
            $table->unsignedBigInteger('user_id')->nullable();//campo para relacion                     
            
            $table->foreign('meta_id')
                    ->references('id')->on('metas')//tabla
                    ->onDelete('cascade');
                    
            $table->foreign('pagina_id')
                    ->references('id')->on('paginas');

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
        Schema::dropIfExists('resgistro_producidos');
    }
}
