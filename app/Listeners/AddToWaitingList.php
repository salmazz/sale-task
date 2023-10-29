<?php

namespace App\Listeners;

use App\Models\WaitingList;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddToWaitingList
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        WaitingList::create([
            'customer_id' => $event->customerId,
            'capacity'=> $event->capacity,
            'to_time' => $event->toTime,
            'from_time' => $event->fromTime
        ]);
    }
}
