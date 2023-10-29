<?php

namespace App\Services\Payment;

use App\Services\Payment\PaymentStrategyInterface;

class TaxesAndServiceStrategyService implements PaymentStrategyInterface
{
    public function calculateTotal($total)
    {
        // Calculate total with service charge only
        return $total * (1 + 0.15);
    }
}
