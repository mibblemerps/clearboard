<?php

namespace App;

use App\PostProcessor\PostProcessor;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    /**
     * Get the thread containing the post
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }

    /**
     * Get the original poster of the post
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function poster()
    {
        return $this->hasOne('App\User', 'id', 'poster_id');
    }

    /**
     * Get body of post.
     * Automatically applies filters.
     * @param bool|false $skipFilter Should the post skip the filters?
     * @return string Post content
     */
    public function getBody($skipFilter = false)
    {
        $content = $this->body;

        if (!$skipFilter) {
            // Run post through filters
            $content = PostProcessor::postProcess($content);
        }

        return $content;
    }

    /**
     * Return partial view of post
     * @return \Illuminate\View\View
     */
    public function getPostView()
    {
        return view('clearboard.partials.post', ['post' => $this]);
    }
}
