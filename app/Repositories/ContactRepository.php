<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    /**
     * Get contacts paginate.
     *
     * @param  int  $nbrPages
     * @param  array  $parameters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($nbrPages, $parameters)
    {
        return Contact::with ('ingoing')
            ->latest()
            ->when ($parameters['new'], function ($query) {
                $query->has ('ingoing');
            })->paginate($nbrPages);
    }
}