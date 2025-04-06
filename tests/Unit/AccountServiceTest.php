<?php

namespace Tests\Unit;

use App\Models\Account;
use PHPUnit\Framework\TestCase;
use App\Services\AccountService;

class AccountServiceTest extends TestCase
{
    public function test_format_account_response()
    {
        $account = new Account();
        $account->numero_conta = 1;
        $account->saldo = 30.2299999;

        $accountService = new AccountService();
        $response = $accountService->formatAccountResponse($account);

        $this->assertEquals(
            ['numero_conta' => 1, 'saldo' => 30.23], 
            $response
        );
    }
}