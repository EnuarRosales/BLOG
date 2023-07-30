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
        Schema::table('user_empresa', function (Blueprint $table) {
            $table->primary(['user_id', 'empresa_id']);

            $table->foreign('user_id')
                ->references('id')->on('users');

            $table->foreign('empresa_id')
                ->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_empresa', function (Blueprint $table) {
            $table->dropForeign('user_empresa_user_id_foreign');
            $table->dropForeign('user_empresa_empresa_id_foreign');
            $table->dropPrimary(['user_id', 'empresa_id']);
        });
    }
};
