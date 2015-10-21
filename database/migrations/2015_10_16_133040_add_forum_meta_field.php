<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForumMetaField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forums', function(Blueprint $table) {
            $table->string('meta', 255); // meta field for extra information (eg. URL for a redirect forum)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forums', function(Blueprint $table) {
            $table->dropColumn('meta');
        });
    }
}
