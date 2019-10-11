<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewTaskPushesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sent_pushes_handle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->passthru('varchar', 'event_id', 'varchar(50)')->index();
            $table->passthru('int', 'type_push')->unsigned()->index();
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
        Schema::dropIfExists('sent_pushes_handle');
    }
}
