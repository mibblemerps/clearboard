<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class ProfileController extends Controller
{
    /**
     * View profile
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfile($uid)
    {
        return view('clearboard.pages.profile', ['user' => User::findOrFail($uid)]);
    }
}
