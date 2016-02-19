<?php

namespace App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Handles sudo mode.
 *
 * @package App\Authorization
 */
class Sudo
{
    /**
     * Check if the user currently has sudo status.
     *
     * @param Request $request
     * @return bool
     */
    public static function isSudo(Request $request)
    {
        if (Auth::check()) {
            // Not logged-in users cannot be in sudo mode. That'd be stupid.
            return false;
        }

        $sudoExpiry = $request->session()->get('sudo') + config('auth.sudo.expire') * 60;

        return ( ($sudoExpiry !== null) && (time() < $sudoExpiry) );
    }

    /**
     * Enable sudo for this user.
     *
     * @param Request $request
     */
    public static function enableSudo(Request $request)
    {
        if (!Auth::check()) {
            abort(401); // 401 Unauthorized
        }

        $request->session()->put('sudo', time());
    }
}
