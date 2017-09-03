<?php

namespace App\Http\Controllers\Back;

use App\ {
    Models\Comment,
    Repositories\CommentRepository,
    Http\Controllers\Controller
};

class CommentController extends Controller
{
    use Indexable;

    /**
     * Create a new CommentController instance.
     *
     * @param  \App\Repositories\CommentRepository $repository
     */
    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'comments';
    }

    /**
     * Update "new" field for comment.
     *
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function updateSeen(Comment $comment)
    {
        $comment->ingoing->delete ();

        return response ()->json ();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete ();

        return response ()->json ();
    }
}
