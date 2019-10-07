<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable
 * Users
 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->passthru('varchar', 'ad_login', 'varchar(100)');
            $table->passthru('nvarchar', 'tab_no', 'varchar(100)');
            $table->passthru('varchar', 'id_person', 'varchar(100)');
            $table->passthru('varchar', 'email', 'varchar(100)');
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
        Schema::dropIfExists('users');
    }
}
