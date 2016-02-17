<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddUserLastActiveAndBirthdayColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            // Timestamp of when the user last performed an action on the site.
            $table->bigInteger('last_active')->nullable();

            // Date when the user was born.
            $table->date('birthdate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('last_active');
            $table->dropColumn('birthdate');
        });
    }
}
