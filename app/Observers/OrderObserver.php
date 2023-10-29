<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderObserver
{
    public function created(Order $order)
    {
        // Calculate and update meal quantities when an order is being created
        dd($order);
        foreach ($order->orderDetails as $detail) {
            dd($detail->meal);
            $meal = $detail->meal;
            if ($meal) {
                $meal->available_quantity -= $detail->quantity;
                $meal->save();
            }
        }
    }
}
