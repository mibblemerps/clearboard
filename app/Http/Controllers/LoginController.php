<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
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

    public function postRegister(Request $request)
    {
        $errors = [];

        // Validate all fields have been received.
        $validator = \Validator::make($request->all(), array(
            'email' => 'required|email|max:128|unique:users,email',
            'username' => 'required|min:1|max:32|unique:users,name',
            'password' => 'required|min:6|max:255'
        ));

        if ($validator->fails()) {
            // Validator detected some problems.
            foreach($validator->errors()->getMessages() as $error) {
                $errors[] = $error;
            }
        }

        if (count($errors) > 0) {
            // Errors detected, generate response
            $response = new Response(json_encode([
                'status' => false,
                'errors' => $errors
            ]), 200);
            $response->header('Content-Type', 'application/json');

            return $response;
        }

        // Get input
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');

        // Register user
        User::register($email, $username, $password);

        // Generate response
        $response = new Response(json_encode([
            'status' => true
        ]), 200);
        $response->header('Content-Type', 'application/json');

        return $response;
    }
}
