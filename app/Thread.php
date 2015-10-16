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

    public function poster()
    {
        return $this->hasOne('App\Post');
    }
}
