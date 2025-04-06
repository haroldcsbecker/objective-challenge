<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use  App\Services\Payment\CreditStrategy;

class CreditStrategyTest extends TestCase
{
    public function test_credit_calculate_fee()
    {
        $strategy = new CreditStrategy();
        $this->assertEquals(0.5, $strategy->calculateFee(10));
    }
}