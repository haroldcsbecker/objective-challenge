<?php

namespace App\Services\Payment;

use App\Enums\FeePercentage;
use App\Contracts\PaymentInterface;

class CreditStrategy implements PaymentInterface
{
    public function calculateFee(float $value): float {
		    return $value * (FeePercentage::CREDIT->value / 100);
    }
}