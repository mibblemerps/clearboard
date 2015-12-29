<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class InsertDefaultGroups extends Migration
{
    /**
     * Default permission nodes to be given to standard users.
     *
     * @var string[]
     */
    private $defaultUserPermissions = [
        'view.index',
        'view.forum',
        'view.thread',
        'view.profile',
        'post',
        'post.thread',
        'edit'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('groups')->insert(array(
            'name' => 'User',
            'inherits' => 0,
            'perms' => json_encode($this->defaultUserPermissions)
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('groups')->where('name', 'User')->delete();
    }
}
