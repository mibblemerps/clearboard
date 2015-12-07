<?php

namespace App\Settings;

use Illuminate\Support\Facades\DB;
use Psy\Exception\RuntimeException;

/**
 * Class for interacting with Clearboard settings (the ones stored in the DB).
 * @package App\Settings
 */
class Settings
{
    public function set($key, $value)
    {
        $affected = DB::table('settings')->where('key', $key)->update(['value' => $value]);
        if ($affected === 0) {
            // Key doesn't exist in database. Insert it.
            DB::table('settings')->insert([
                'key' => $key,
                'value' => $value
            ]);
        }
    }

    public function get($key)
    {
        // Fetch setting from database
        $results = DB::table('settings')->where('key', $key)->select('value')->get();

        if (count($results) === 0) {
            throw new RuntimeException('Attempt to read non-existent setting');
        }

        return $results[0]->value;
    }
}