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
        Schema::create('new_task_pushes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->passthru('varchar', 'task_id', 'varchar(50)')->index();
            $table->passthru('int', 'status');
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
        Schema::dropIfExists('new_task_pushes');
    }
}