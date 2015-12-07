<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert(['key' => 'clearboard.sitename', 'value' => 'Clearboard']);
        DB::table('settings')->insert(['key' => 'clearboard.rules_url', 'value' => '#']);
        DB::table('settings')->insert(['key' => 'clearboard.tos_url', 'value' => '#']);
        DB::table('settings')->insert(['key' => 'clearboard.privacy_url', 'value' => '#']);

        DB::table('settings')->insert(['key' => 'clearboard.board_message', 'value' => '']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
