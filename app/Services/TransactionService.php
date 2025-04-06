<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService
{
    public function create(array $transaction) {
        return Transaction::create([ ...$transaction ]);
    }
}