<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;

class Comment extends Model
{
    use IngoingTrait;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['body', 'post_id', 'user_id', 'parent_id'];

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function replies()
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function validReplies()
    {
        return $this->replies()->whereHas('user', function ($q) {
            $q->whereValid(true);
        })->latest();
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function allRepliesWithOwner()
    {
        return $this->validReplies()->with(__FUNCTION__, 'user');
    }
}
