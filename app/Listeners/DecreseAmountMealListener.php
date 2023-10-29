<?php

namespace App\Listeners;

use App\Models\Order;
use App\Models\WaitingList;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DecreseAmountMealListener
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
        $order = Order::find($event->order);
        foreach ($order->orderDetails as $detail) {
            $meal = $detail->meal;
            if ($meal) {
                $meal->available_quantity -= $detail->quantity;
                $meal->save();
            }
        }
    }
}
