<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableauUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tableau_users', function (Blueprint $table) {
            $table->passthru('varchar', 'id_phperson', 'varchar(100)')->index();
            $table->passthru('bigint', 'tableau_id')->unsigned();

            $table->foreign('tableau_id')->references('id')->on('tableau')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tableau_users');
    }
}
