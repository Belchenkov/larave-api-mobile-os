<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableauTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tableau', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->passthru('nvarchar', 'title', 'nvarchar(255)');
            $table->passthru('nvarchar', 'tableau_url', 'nvarchar(2048)');
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
        Schema::dropIfExists('tableau');
    }
}
