<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->passthru('bigint', 'user_id')->unsigned();
            $table->passthru('varchar', 'device_id', 'varchar(255)')->index()->nullable();
            $table->passthru('bigint', 'session_id')->unsigned();
            $table->timestamps();

            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('user_jwt_tokens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_devices');
    }
}
