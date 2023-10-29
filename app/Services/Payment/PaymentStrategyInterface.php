<?php

namespace App\Services\Payment;

interface PaymentStrategyInterface
{
    public function calculateTotal($total);
}
