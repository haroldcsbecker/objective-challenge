<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\PaymentFactory;
use App\Http\Controllers\Controller;
use App\Enums\TransactionErrorMessage;
use App\Http\Requests\StoreTransactionRequest;

class TransactionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request, PaymentFactory $factory)
    {
        $validated = $request->validated();
        $account = Account::where('numero_conta', $validated['numero_conta'])->first();
        
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

        $transaction = Transaction::create([
            ...$validated,
            'taxa' => $paymentFee
        ]);

        $newBalance = $account->saldo - $totalTransaction;
        $account->update([
            'saldo' => $newBalance
        ]);

        // Ensures the accuracy of the saldo returned
        $response = [ 
            'numero_conta' => $account->numero_conta,
            'saldo' => number_format($newBalance, 2)
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }
}
