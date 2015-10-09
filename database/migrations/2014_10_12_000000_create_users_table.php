<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id'); // User ID
            $table->string('name'); // Username
            $table->string('email')->unique(); // Email address
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();

            $table->string('icon'); // Users avatar. Can be filename, "$gravatar" or "$default".
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
