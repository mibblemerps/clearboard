<?php

namespace App\Http\Controllers\Auth;

use App\Authorization\Sudo;
use App\User;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Logs in and returns the result through a simple JSON response.
     *
     * @param Request $request
     * @return string
     */
    public function postAjaxLogin(Request $request)
    {
        // Ensure arguments are present.
        if (!( $request->has('username') && $request->has('password') )) {
            abort(400); // Missing arguments - 400 Bad Request
        }
        $username = $request->input('username');
        $password = $request->input('password');

        if ($this->hasTooManyLoginAttempts($request)) {
            // Had too many login attempts. Lock out user.
            return [
                'success' => false,
                'tries_remaining' => 0
            ];
        }

        // Attempt login
        if (Auth::attempt(['name' => $username, 'password' => $password])) {
            // Successful login - reset failed login attempts
            $this->clearLoginAttempts($request);

            // Return success response
            return [
                'success' => true
            ];
        } else {
            // Increment failed login attempt counter
            $this->incrementLoginAttempts($request);

            // Return failure response
            return [
                'success' => false,
                'tries_remaining' => $this->retriesLeft($request)
            ];
        }
    }

    /**
     * Request to enter sudo mode. This allows the user to make dangerous changes for a short while.
     *
     * Takes 1 POST argument, "password".
     *
     * @param Request $request
     * @return string
     */
    public function postSudo(Request $request)
    {
        if ($request->has('password')) {
            // Verify password against hash
            $valid = Hash::check(
                $request->input('password'),
                Auth::user()->password
            );

            if ($valid) {
                // Authenticated. Enter sudo mode.
                Sudo::enableSudo($request);
                return ['status' => true];
            } else {
                abort(401); // 401 Unauthorized
            }
        } else {
            abort(400); // 400 Bad Request
        }
    }
}
