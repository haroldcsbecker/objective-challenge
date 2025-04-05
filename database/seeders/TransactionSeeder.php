<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::factory()->create([
            'valor' => 1235,
            'taxa' => 40,
            'forma_pagamento' => 'D'
        ]);
    }
}
