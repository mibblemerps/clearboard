<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getAvatarUrl()
    {
        // Generate Gravatar link
        $email = trim($this->email);
        $gravatarEndpoint = '//www.gravatar.com/avatar/';
        $gravatarUrl = $gravatarEndpoint . md5($email) . '?size=150&d=monsterid';
        return $gravatarUrl;
    }

    /**
     * Register a new user and save it to the database.
     * @param string $email
     * @param string $username
     * @param string $password
     */
    public static function register($email, $username, $password)
    {
        // Create user object
        $user = new User();
        $user->email = $email;
        $user->name = $username;
        $user->password = Hash::make($password);

        // Save to database
        $user->save();

        return $user;
    }
}
