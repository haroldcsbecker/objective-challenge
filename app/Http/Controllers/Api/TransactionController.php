<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AccountService;
use App\Services\PaymentFactory;
use App\Services\TransactionService;
use App\Http\Controllers\Controller;
use App\Enums\TransactionErrorMessage;
use App\Http\Requests\StoreTransactionRequest;

class TransactionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(
        TransactionService $transactionService,
        StoreTransactionRequest $request,
        AccountService $accountService,
        PaymentFactory $factory,
    ) {
        $validated = $request->validated();
        $account = $accountService->getAccountByNumber($validated['numero_conta']);
        
        $strategy = $factory->createStrategy($validated['forma_pagamento']);
        $paymentFee = $strategy->calculateFee($validated['valor']);
        $totalTransaction = $validated['valor'] + $paymentFee;

        $insufficientBalance = $account->saldo < $totalTransaction;
        if ($insufficientBalance) {
            return response()->json(
                ['message' => TransactionErrorMessage::INSUFFICIENT_BALANCE], 
                Response::HTTP_NOT_FOUND
            );
        }

        $transaction = $transactionService->create([
            ...$validated,
            'taxa' => $paymentFee
        ]);
        $accountService->updateBallance($account, $totalTransaction);
        $response = $accountService->formatAccountResponse($account);

        return response()->json($response, Response::HTTP_CREATED);
    }
}
