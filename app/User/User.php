<?php

namespace App\User;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function group()
    {
        return $this->belongsTo('App\User\Group');
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
     * Does the user have a badge?
     * @return bool
     */
    public function hasBadge()
    {
        return !!$this->group->badge;
    }

    /**
     * Get the users badge (url).
     * @return null|string Absolute URL to badge. Returns null if user has no badge.
     */
    public function getBadge()
    {
        if (!$this->group->badge) {
            return null;
        }
        return url($this->group->badge);
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
     * Does the user (or more specifically their group and child groups) have a specific permission node?
     * Wrapper for hasPermissionNode().
     *
     * @param $node
     * @return bool
     */
    public function can($node)
    {
        return $this->hasPermissionNode($node);
    }

    /**
     * Update the users last active timestamp.
     */
    public function updateLastActive()
    {
        $this->last_active = time();
        $this->save();
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
