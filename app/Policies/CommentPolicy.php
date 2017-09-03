<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
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
        if ($user->role == 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can update the comment.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Comment $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        return $user->id == $comment->user_id;
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Comment $comment
     * @return boolean
     */
    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
