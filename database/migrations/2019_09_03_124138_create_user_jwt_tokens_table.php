<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUserJwtTokensTable
 */
class CreateUserJwtTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_jwt_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->passthru('bigint', 'user_id')->unsigned();
            $table->passthru('varchar', 'access_token', 'varchar(100)');
            $table->passthru('varchar', 'refresh_token', 'varchar(100)');
            $table->passthru('varchar', 'user_agent', 'varchar(255)')->nullable();
            $table->passthru('varchar', 'ip_address', 'varchar(15)')->nullable();
            $table->passthru('smalldatetime', 'access_expire_at');
            $table->passthru('smalldatetime', 'refresh_expire_at');
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
        Schema::dropIfExists('user_jwt_tokens');
    }
}
