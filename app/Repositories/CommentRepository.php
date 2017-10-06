<?php

namespace App\Repositories;

use App\Models\ {
    Comment,
    Post
};

class CommentRepository
{
    /**
     * Get comments paginate.
     *
     * @param  int  $nbrPages
     * @param  array  $parameters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($nbrPages, $parameters)
    {
        return Comment::with ([
                'ingoing',
                'user',
                'post' => function ($query) { $query->withCount('comments'); }
            ])
            ->latest()
            ->when ($parameters['new'], function ($query) {
                $query->has ('ingoing');
            })->when ($parameters['valid'], function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->whereValid(true);
                });
            })->paginate($nbrPages);
    }

    /**
     * Get next post comments.
     *
     * @param  \App\Models\Post  $post
     * @param  integer  $page
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getNextComments(Post $post, $page)
    {
        return $post->parentComments()
            ->with('user')
            ->latest()
            ->skip($page * config('app.numberParentComments'))
            ->take(config('app.numberParentComments'))
            ->get();
    }
}
