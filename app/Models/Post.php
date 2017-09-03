<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\ {
    ModelCreated,
    PostUpdated
};

class Post extends Model
{
    use IngoingTrait;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
        'updated' => PostUpdated::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'seo_title', 'excerpt', 'body', 'meta_description', 'meta_keywords', 'active', 'image', 'user_id'
    ];

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
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function validComments()
    {
        return $this->comments()->whereHas('user', function ($query) {
            $query->whereValid(true);
        });
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function parentComments()
    {
        return $this->validComments()->whereParentId(null);
    }

    /**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
