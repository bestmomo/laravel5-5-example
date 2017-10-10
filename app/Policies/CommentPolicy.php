<?php

namespace App\Policies;

use App\Models\ {User, Comment};

class CommentPolicy extends Policy
{
    /**
     * Determine whether the user can manage the comment.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Comment $comment
     * @return mixed
     */
    public function manage(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
