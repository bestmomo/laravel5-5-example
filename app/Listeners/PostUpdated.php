<?php

namespace App\Listeners;

use App\Events\PostUpdated as EventPostUpdated;
use App\Services\Thumb;

class PostUpdated
{
    /**
     * Handle the event.
     *
     * @param  PostUpdated  $event
     * @return void
     */
    public function handle(EventPostUpdated $event)
    {
        if($event->model->image != $event->model->getOriginal ('image')) {
            Thumb::makeThumb ($event->model);
        }
    }
}
