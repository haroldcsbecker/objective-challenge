<?php

namespace App\Services\Payment;

use App\Enums\FeePercentage;
use App\Contracts\PaymentInterface;

class DebitStrategy implements PaymentInterface
{
    public function calculateFee(float $value): float {
		    return $value * (FeePercentage::DEBIT->value / 100);
    }
}