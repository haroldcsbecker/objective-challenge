<?php

namespace App\Http\Requests;

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
    public function rules(): array
    {
        return [
            'forma_pagamento' => [ 'required', Rule::enum(PaymentMethods::class) ],
            'numero_conta' => [ 'required', 'exists:accounts' ],
            // verificar isso quando for pix ser mais que 0s
            'valor' => [ 'required', 'gte:1' ],
        ];
    }
}
