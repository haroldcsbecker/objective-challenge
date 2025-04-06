<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use  App\Services\Payment\PixStrategy;

class PixStrategyTest extends TestCase
{
    public function test_pix_calculate_fee()
    {
        $strategy = new PixStrategy();
        $this->assertEquals(0, $strategy->calculateFee(10));
    }
}