<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRequestMailsTable
 * Send Requests to mail
 */
class CreateRequestSupportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_support', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->passthru('bigint', 'user_id')->unsigned();
            $table->integer('type_request')->index();
            $table->passthru('nvarchar', 'comment', 'nvarchar(200)');
            $table->passthru('nvarchar', 'from', 'nvarchar(200)');
            $table->passthru('nvarchar', 'to', 'nvarchar(200)');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_support');
    }
}
