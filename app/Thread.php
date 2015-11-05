<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Thread extends Model
{
    protected $table = 'threads';

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * Fetch the first post within the thread
     * @return Post
     */
    public function getOP()
    {
        $op = Post::where('thread_id', $this->id)->first();
        return $op;
    }

    /**
     * Fetch the initial poster of the thread
     * @return User
     */
    public function getPoster()
    {
        $posterid = $this->getOP()->poster_id;
        $poster = User::where('id', $posterid)->first();
        return $poster;
    }
}
