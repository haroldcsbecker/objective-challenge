<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'valor',
        'taxa',
        'forma_pagamento',
        'numero_conta'
    ];

    /**
     * Get the account that owns the transaction.
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'foreign_key', 'numero_conta');
    }
}
