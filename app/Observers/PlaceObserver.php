<?php

namespace App\Observers;

use App\Models\place;

class PlaceObserver
{
    /**
     * Handle the place "created" event.
     */
    public function created(place $place): void
    {
        if($place){
            cache()->forget('places');
        }
    }

    /**
     * Handle the place "updated" event.
     */
    public function updated(place $place): void
    {
        //
    }

    /**
     * Handle the place "deleted" event.
     */
    public function deleted(place $place): void
    {
        //
    }

    /**
     * Handle the place "restored" event.
     */
    public function restored(place $place): void
    {
        //
    }

    /**
     * Handle the place "force deleted" event.
     */
    public function forceDeleted(place $place): void
    {
        //
    }
}
