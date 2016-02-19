<?php

namespace App\Http\Controllers;

use App\User\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Registration page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        return view('clearboard.register.register');
    }

    /**
     * JSON based interface for registering new users.
     * Requires the following POST arguments
     *  - email: a valid email address
     *  - username: a unique alias for the user
     *  - password: a password with a minimum length of 6 characters
     *  - g-recaptcha-response: the response from a Google reCAPTCHA
     *
     * @param Request $request
     * @return Response
     */
    public function postRegister(Request $request)
    {
        $errors = [];

        // Validate all fields have been received.
        $validator = \Validator::make($request->all(), array(
            'email' => 'required|email|max:128|unique:users,email',
            'username' => 'required|min:1|max:20|unique:users,name',
            'password' => 'required|min:6|max:255',
            'g-recaptcha-response' => 'recaptcha'
        ));

        if ($validator->fails()) {
            // Validator detected some problems.
            foreach($validator->errors()->getMessages() as $error) {
                $errors[] = $error;
            }
        }

        if (count($errors) > 0) {
            // Errors detected, abort with errors.
            return [
                'status' => false,
                'errors' => $errors
            ];
        }

        // Get input
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');

        // Register user
        $user = User::register($email, $username, $password);

        // Login
        Auth::login($user);

        // All good. :)
        return [
            'status' => true
        ];
    }
}
