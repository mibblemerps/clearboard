<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User\User;

class SettingsController extends Controller
{
    /**
     * View settings page.
     *
     * @param int|null $userid User ID of settings to view. Defaults to current user.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($userid = null)
    {
        if ($userid === null) { $userid = Auth::user()->id; }

        return view('clearboard.settings.settings', ['user' => User::find($userid)]);
    }
}
