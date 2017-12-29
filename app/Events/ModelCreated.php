<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;

class ModelCreated {
	use SerializesModels;

	public $model;

	/**
	 * Create a new event instance.
	 *
	 * @param Model $model
	 */
	public function __construct( Model $model )
	{
		$this->model = $model;
	}
}
