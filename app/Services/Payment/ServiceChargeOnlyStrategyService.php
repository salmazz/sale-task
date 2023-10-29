<?php

namespace App\Services\Payment;

use App\Services\Payment\PaymentStrategyInterface;

class ServiceChargeOnlyStrategyService implements PaymentStrategyInterface
{
    public function calculateTotal($total)
    {
        // Calculate total with taxes and service charge
        return $total * (1 + 0.14) * (1 + 0.20);
    }
}
