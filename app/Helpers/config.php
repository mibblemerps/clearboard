<?php

if (!function_exists('setconfig')) {
    /**
     * Save a config value. Will be persisted on disk.
     *
     * @param $key Setting key. Example: 'clearboard.sitename'
     * @param $value New value.
     */
    function setconfig($key, $value)
    {
        \App\Facades\Userconfig::set($key, $value);
    }
}
