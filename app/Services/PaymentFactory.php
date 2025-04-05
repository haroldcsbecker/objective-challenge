<?php

namespace App\Services;

use App\Enums\PaymentMethods;
use App\Services\Payment\PixStrategy;
use App\Services\Payment\CreditStrategy;
use App\Services\Payment\DebitStrategy;

class PaymentFactory
{	
	public function createStrategy(string $paymentMethod) {
		return match ($paymentMethod) {
            PaymentMethods::PIX->value => new PixStrategy(),
            PaymentMethods::CREDIT->value => new CreditStrategy(),
            PaymentMethods::DEBIT->value => new DebitStrategy(),
        };
	}
}