<?php

namespace App\Services\Payment;

use App\Enums\FeePercentage;
use App\Contracts\PaymentInterface;

class PixStrategy implements PaymentInterface
{
    public function calculateFee(float $value): float {
	    return $value * (FeePercentage::PIX->value / 100);
    }
}