<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Userconfig
 * @package App\Userconfig
 */
class Userconfig extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'userconfig';
    }
}