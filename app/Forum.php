<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $table = 'forums';

    public function threads()
    {
        return $this->hasMany('App\Thread');
    }

    /**
     * Generate a user friendly URL for this forum.
     * Example: /forum/2-General-Discussion
     * @return string
     */
    public function getUserFriendlyURL()
    {
        return url('forum/' . $this->id . '-' . urlencode(
                str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 \-]/', '', $this->name))
            ));
    }
}
