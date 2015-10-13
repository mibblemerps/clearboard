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
}
