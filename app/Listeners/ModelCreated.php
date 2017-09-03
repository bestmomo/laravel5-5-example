<?php

namespace App\Listeners;

use App\Events\ModelCreated as EventModelCreated;
use App\Models\Ingoing;
use App\Services\Thumb;

class ModelCreated
{
    /**
     * Handle the event.
     *
     * @param  EventModelCreated  $event
     * @return void
     */
    public function handle(EventModelCreated $event)
    {
        $event->model->ingoing()->save(new Ingoing);

        Thumb::makeThumb ($event->model);
    }
}
