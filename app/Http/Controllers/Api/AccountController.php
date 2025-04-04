<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Enums\AccountErrorMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\StoreAccountRequest;

class AccountController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        $validated = $request->validated();

        $account = Account::create([
            'numero_conta' => $request->input('numero_conta'),
            'saldo' => $request->input('saldo')
        ]);

        return response()->json($account, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $numero_conta)
    {

        $account = Account::where('numero_conta', $numero_conta)->first();

        if ($account->isEmpty()) {
            return response()->json(
                ['message' => AccountErrorMessage::NOT_FOUND],
                Response::HTTP_NOT_FOUND
            );
        }

        return response()->json($account, Response::HTTP_OK);
    }
}
