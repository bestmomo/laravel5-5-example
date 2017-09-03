<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingoing extends Model
{
	/**
     * Morph To relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
	public function ingoing()
	{
		return $this->morphTo();
	}
}
