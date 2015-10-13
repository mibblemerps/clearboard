<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $table = 'threads';

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
