<?php

namespace app\Facades;

use Illuminate\Support\Facades\Facade;

class PostProcessor extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'postprocessor';
    }
}