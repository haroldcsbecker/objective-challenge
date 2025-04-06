<?php

namespace App\Services;

use App\Models\Account;
use Illuminate\Http\Response;

class AccountService
{
    public function getAccountByNumber(string $accountNumber) {
        return Account::where('numero_conta', $accountNumber)->first();
    }
    
    public function create(array $account) {
        return Account::create([ ...$account ]);
    }

    public function updateBallance(Account $account, float $value) {
        $newBalance = $account->saldo - $value;

        return $account->update([ 'saldo' => $newBalance ]);
    }

    // Ensures the accuracy of the saldo returned
    public function formatAccountResponse(Account $account,): array {
        return [ 
            'numero_conta' => $account->numero_conta,
            'saldo' => number_format($account->saldo, 2)
        ];
    }
}