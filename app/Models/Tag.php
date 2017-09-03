<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tag'];

	/**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function posts()
	{
		return $this->belongsToMany(Post::class);
	}
}
