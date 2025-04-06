<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use  App\Services\Payment\DebitStrategy;

class DebitStrategyTest extends TestCase
{
    public function test_debit_calculate_fee()
    {
        $strategy = new DebitStrategy();
        $this->assertEquals(0.3, $strategy->calculateFee(10));
    }
}