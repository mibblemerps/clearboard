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
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    /**
     * Get link to this users avatar
     *
     * @param int $size Size in pixels. All avatars are square.
     * @return string Url to avatar.
     */
    public function getAvatarUrl($size = 150)
    {
        // Generate Gravatar link
        $email = trim( strtolower($this->email) );
        $gravatarApi = '//www.gravatar.com/avatar/';
        return $gravatarApi . md5($email) . '?s=' . urlencode($size) . '&d=monsterid';
    }

    /**
     * Style this users username according to their groups styling rules.
     *
     * @return string
     */
    public function getStyledUsername()
    {
        return $this->group()->first()->styleUsername(htmlentities($this->name));
    }

    /**
     * Get human friendly URL to users profile page
     *
     * @return string
     */
    public function getProfileUrl()
    {
        return url('/profile/' . $this->id . '-' .
            str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 \-]/', '', $this->name))
        );
    }

    /**
     * Does the user (or more specifically their group and child groups) have a specific permission node?
     *
     * @param string $node
     * @return boolean
     */
    public function hasPermissionNode($node)
    {
        return $this->group()->get()->first()->hasPermissionNode($node);
    }

    /**
     * Register a new user and save it to the database.
     *
     * @param string $email
     * @param string $username
     * @param string $password
     * @return User
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
