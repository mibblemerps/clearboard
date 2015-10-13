<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function(Blueprint $table) {
            $table->increments('id'); // Post ID
            $table->integer('thread_id'); // Thread containing the post
            $table->integer('poster_id'); // Poster who posted the post
            $table->text('body'); // Body of the post
            $table->boolean('hidden'); // Is the post hidden to standard users?
            $table->timestamps(); // Timestamps
            $table->softDeletes(); // Posts aren't permanently deleted.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
