<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    public function authenticateJson(Request $request) {
        // Ensure arguments are present.
        if (!($request->has('username') && $request->has('password'))) {
            // Missing arguments!
            abort(400); // Bad Request
        }

        $username = $request->input('username');
        $password = $request->input('password');

        // Responses will be in JSON
        header('Content-Type: application/json');

        // Attempt login
        if (Auth::attempt(['name' => $username, 'password' => $password])) {
            // Return success response
            return json_encode(array(
                'success' => true
            ));
        } else {
            // Return failure response
            return json_encode(array(
                'success' => false
            ));
        }
    }
}
