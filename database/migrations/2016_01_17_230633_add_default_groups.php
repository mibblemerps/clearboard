<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Clear old groups
        DB::table('groups')->truncate();

        // Add user group.
        DB::table('groups')->insert([
            'name' => 'User',
            'inherits' => 0,
            'perms' => json_encode([
                'cb.login',
                'cb.index.view',
                'cb.thread.view',
                'cb.profile.view',
                'cb.thread.create',
                'cb.post.create',
                'cb.post.edit'
            ]),
            'username_formatting' => '$username',
            'badge' => ''
        ]);

        // Add moderator group.
        DB::table('groups')->insert([
            'name' => 'Moderator',
            'inherits' => 1,
            'perms' => json_encode([
                'cb.post.create.inLocked',
                'cb.post.edit.others'
            ]),
            'username_formatting' => '<span style="color:blue;">$username</span>',
            'badge' => 'global_assets/badges/moderator.png'
        ]);

        // Add administrator group.
        DB::table('groups')->insert([
            'name' => 'Administrator',
            'inherits' => 2,
            'perms' => json_encode([]),
            'username_formatting' => '<span style="color:red;">$username</span>',
            'badge' => 'global_assets/badges/admin.png'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('groups')->truncate();

        // Rerun original insert groups migration.
        $insertDefaultGroupsMigration = new InsertDefaultGroups();
        $insertDefaultGroupsMigration->up();
    }
}
