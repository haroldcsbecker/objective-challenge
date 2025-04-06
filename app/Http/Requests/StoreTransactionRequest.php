<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use App\Enums\PaymentMethods;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        $rules = [
            'forma_pagamento' => ['required', Rule::enum(PaymentMethods::class)],
            'numero_conta' => ['required', 'exists:accounts'],
            'valor' => ['required', 'gte:1'],
        ];

        if ($request->input('forma_pagamento') === PaymentMethods::PIX->value) {
            $rules['valor'] = ['required', 'gte:0'];
        }

        return $rules;
    }
}
