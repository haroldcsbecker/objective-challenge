<?php

namespace App\Enums;

enum PaymentMethods: string
{
    case PIX = 'P';
    case CREDIT = 'C';
    case DEBIT = 'D';
}
