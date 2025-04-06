<?php

namespace App\Enums;

enum TransactionErrorMessage: string
{
    case INSUFFICIENT_BALANCE = 'Insufficient balance to complete the transaction.';
}
