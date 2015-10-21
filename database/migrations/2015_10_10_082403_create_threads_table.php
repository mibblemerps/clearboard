<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->increments('id'); // Thread ID
            $table->integer('forum_id');
            $table->string('name'); // Thread title
            $table->boolean('locked'); // Is the thread closed to new replies?
            $table->boolean('hidden'); // Is the thread hidden to normal users?
            $table->timestamps(); // Thread timestamps
            $table->softDeletes(); // Soft delete columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forums');
    }
}
