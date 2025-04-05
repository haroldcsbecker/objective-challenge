<?php

namespace App\Enums;

enum FeePercentage: int
{
    case PIX = 0;
    case CREDIT = 5;
    case DEBIT = 3;
}
