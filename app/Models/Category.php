<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Category extends Model {

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'slug';
	}

	/**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
	public function posts()
	{
		return $this->belongsToMany(Post::class);
	}
}
