<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Thread;

class ThreadPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function reply(User $user, Thread $thread)
    {
        if (!$user->hasPermissionNode('cb.post.create')) {
            // User is not allowed to create posts.
            return false;
        } elseif ($thread->locked && !$user->hasPermissionNode('cb.post.create.inLocked')) {
            // User is not allowed to post in locked threads.
            return false;
        }

        return true;
    }
}
