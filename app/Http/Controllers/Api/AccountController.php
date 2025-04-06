<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AccountService;
use App\Enums\AccountErrorMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShowAccountRequest;
use App\Http\Requests\StoreAccountRequest;

class AccountController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request, AccountService $accountService)
    {
        $validated = $request->validated();
        $account = $accountService->create($validated);

        return response()->json($account, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowAccountRequest $request, AccountService $accountService)
    {   
        $validated = $request->validated();
        $account = $accountService->getAccountByNumber($validated['numero_conta']);

        if (!$account) {
            return response()->json(
                ['message' => AccountErrorMessage::NOT_FOUND],
                Response::HTTP_NOT_FOUND
            );
        }

        return response()->json($account, Response::HTTP_OK);
    }
}
