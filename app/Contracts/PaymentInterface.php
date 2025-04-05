<?php

namespace App\Contracts;

interface PaymentInterface
{
    public function calculateFee(float $value): float;
}