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
            $table->passthru('varchar', 'access_token', 'varchar(255)');
            $table->passthru('varchar', 'refresh_token', 'varchar(255)');
            $table->passthru('bigint', 'access_expire_at')->unsigned();
            $table->passthru('bigint', 'refresh_expire_at')->unsigned();
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
