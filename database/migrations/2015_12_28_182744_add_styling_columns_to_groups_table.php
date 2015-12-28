<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStylingColumnsToGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups', function(Blueprint $table) {
            // How should this groups username be styled in html. The keyword $username will be replaced with the users username.
            $table->string('username_formatting')->default('$username');

            // A path relative to the public directory to a small image to be placed below a users name on their posts.
            $table->string('badge');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groups', function(Blueprint $table) {
            $table->dropColumn('username_formatting');
            $table->dropColumn('badge');
        });
    }
}
