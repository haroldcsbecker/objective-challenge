<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /** @use HasFactory<\Database\Factories\AccountFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'numero_conta',
        'saldo',
    ];

     /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['numero_conta', 'saldo'];
}
