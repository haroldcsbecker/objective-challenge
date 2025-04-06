<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Enums\AccountErrorMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShowAccountRequest;
use App\Http\Requests\StoreAccountRequest;

class AccountController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        $validated = $request->validated();
        $account = Account::create([ ...$validated ]);

        return response()->json($account, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowAccountRequest $request)
    {   
        $validated = $request->validated();
        $account = Account::where('numero_conta', $validated['numero_conta'])->first();

        if (!$account) {
            return response()->json(
                ['message' => AccountErrorMessage::NOT_FOUND],
                Response::HTTP_NOT_FOUND
            );
        }

        return response()->json($account, Response::HTTP_OK);
    }
}
