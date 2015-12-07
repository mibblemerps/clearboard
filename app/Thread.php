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

    /**
     * Generate a user friendly URL for this thread.
     * Example: /thread/3-Hello_World
     * @return string
     */
    public function getUserFriendlyURL()
    {
        return url('thread/' . $this->id . '-' . urlencode(
                str_replace(' ', '_', preg_replace('/[^A-Za-z0-9\-]/', '', $this->name))
            ));
    }

    /**
     * Create a new thread
     * @param string $title Title of thread
     * @param integer $forumid Forum ID to host the thread
     * @param bool|false $locked Is the thread locked to further replies?
     * @param bool|false $hidden Is the thread hidden from normal view?
     * @param bool|true $save Should the thread be saved to the database?
     */
    public static function newThread($title, $forumid, $locked = false, $hidden = false, $save = true)
    {
        // Create thread definition
        $thread = new Thread();
        $thread->forum_id = $forumid;
        $thread->name = $title;
        $thread->locked = false;
        $thread->locked = $locked; // defaults to unlocked
        $thread->hidden = $hidden; // defaults to not hidden

        // Save thread to database
        if ($save) { $thread->save(); }
    }
}
