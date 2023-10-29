<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomersAddedToWaitingList
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $fromTime;
    public $toTime;
    public $capacity;
    public $customerId;

    /**
     * Create a new event instance.
     */
    public function __construct($capacity, $customerId,$fromTime, $toTime)
    {
        $this->customerId = $customerId;
        $this->capacity = $capacity;
        $this->fromTime = $fromTime;
        $this->toTime = $toTime;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
