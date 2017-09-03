<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Grant all abilities to administrator.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if ($user->role === 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can manage the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function manage(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
