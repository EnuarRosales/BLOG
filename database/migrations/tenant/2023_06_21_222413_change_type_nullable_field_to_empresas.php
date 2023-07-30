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
        DB::statement("ALTER TABLE empresas
                        MODIFY COLUMN name varchar(255) NOT NULL,
                        MODIFY COLUMN nit varchar(255) NOT NULL,
                        MODIFY COLUMN address varchar(255) NOT NULL,
                        MODIFY COLUMN representative varchar(255) NOT NULL,
                        MODIFY COLUMN representative_identification_card varchar(255) NOT NULL,
                        MODIFY COLUMN number_rooms varchar(255) NOT NULL,
                        MODIFY COLUMN capacity_models varchar(255) NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE empresas
                        MODIFY COLUMN name varchar(255),
                        MODIFY COLUMN nit varchar(255),
                        MODIFY COLUMN address varchar(255),
                        MODIFY COLUMN representative varchar(255),
                        MODIFY COLUMN representative_identification_card varchar(255),
                        MODIFY COLUMN number_rooms varchar(255),
                        MODIFY COLUMN capacity_models varchar(255)");
    }
};
