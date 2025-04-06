<?php

use Database\Seeders\AccountSeeder;
use Database\Seeders\TransactionSeeder;

test('[POST] validate required fields', function () {
    $this->seed([AccountSeeder::class, TransactionSeeder::class]);
    $response = $this->post('/api/transacao', []);

    $response->assertInvalid([
        'forma_pagamento' => 'The forma pagamento field is required.',
        'numero_conta' => 'The numero conta field is required.',
        'valor' => 'The valor field is required.',
    ]);
});

test('[POST] validate numero conta exists', function () {
    $this->seed([AccountSeeder::class, TransactionSeeder::class]);
    $response = $this->post(
        '/api/transacao', 
        ['forma_pagamento'=> 'D', 'numero_conta' => 12, 'valor' => 2]
    );

    $response->assertInvalid([
        'numero_conta' => 'The selected numero conta is invalid.',
    ]);
});

test('[POST] validate forma pagamento is a valid option', function () {
    $this->seed([AccountSeeder::class, TransactionSeeder::class]);
    $response = $this->post(
        '/api/transacao', 
        ['forma_pagamento'=> 'B', 'numero_conta' => 1235, 'valor' => 1]
    );

    $response->assertInvalid([
        'forma_pagamento' => 'The selected forma pagamento is invalid.',
    ]);
});

test('[POST] validate valor for DEBIT gte: 1', function () {
    $this->seed([AccountSeeder::class, TransactionSeeder::class]);
    $response = $this->post(
        '/api/transacao', 
        ['forma_pagamento'=> 'D', 'numero_conta' => 1235, 'valor' => 0.5]
    );

    $response->assertInvalid([
        'valor' => 'The valor field must be greater than or equal to 1.',
    ]);
});

test('[POST] validate valor for CREDIT gte: 1', function () {
    $this->seed([AccountSeeder::class, TransactionSeeder::class]);
    $response = $this->post(
        '/api/transacao', 
        ['forma_pagamento'=> 'C', 'numero_conta' => 1235, 'valor' => 0.5]
    );

    $response->assertInvalid([
        'valor' => 'The valor field must be greater than or equal to 1.',
    ]);
});

test('[POST] validate valor for PIX gte: 0', function () {
    $this->seed([AccountSeeder::class, TransactionSeeder::class]);
    $response = $this->post(
        '/api/transacao', 
        ['forma_pagamento'=> 'P', 'numero_conta' => 1235, 'valor' => -1]
    );

    $response->assertInvalid([
        'valor' => 'The valor field must be greater than or equal to 0.',
    ]);
});


test('[POST] validate insufficient balance and fee for CREDIT', function () {
    $this->seed([AccountSeeder::class, TransactionSeeder::class]);
    $response = $this->post(
        '/api/transacao', 
        ['forma_pagamento'=> 'C', 'numero_conta' => 1235, 'valor' => 39]
    );

    $response
        ->assertStatus(404)
        ->assertJson(['message' => 'Insufficient balance to complete the transaction.']);
});

test('[POST] validate insufficient balance and fee for DEBIT', function () {
    $this->seed([AccountSeeder::class, TransactionSeeder::class]);
    $response = $this->post(
        '/api/transacao', 
        ['forma_pagamento'=> 'D', 'numero_conta' => 1235, 'valor' => 39]
    );

    $response
        ->assertStatus(404)
        ->assertJson(['message' => 'Insufficient balance to complete the transaction.']);
});

test('[POST] validate insufficient balance and fee for PIX', function () {
    $this->seed([AccountSeeder::class, TransactionSeeder::class]);
    $response = $this->post(
        '/api/transacao', 
        ['forma_pagamento'=> 'P', 'numero_conta' => 1235, 'valor' => 40.5]
    );

    $response
        ->assertStatus(404)
        ->assertJson(['message' => 'Insufficient balance to complete the transaction.']);
});

test('[POST] Create a valid transaction for CREDIT', function () {
    $this->seed([AccountSeeder::class, TransactionSeeder::class]);
    $response = $this->post(
        '/api/transacao', 
        ['forma_pagamento'=> 'C', 'numero_conta' => 1235, 'valor' => 10]
    );

    $response
        ->assertStatus(201)
        ->assertJson([
            'numero_conta' => '1235',
            'saldo' => '29.50',
        ]);
});

test('[POST] Create a valid transaction for DEBIT', function () {
    $this->seed([AccountSeeder::class, TransactionSeeder::class]);
    $response = $this->post(
        '/api/transacao', 
        ['forma_pagamento'=> 'D', 'numero_conta' => 1235, 'valor' => 10]
    );

    $response
        ->assertStatus(201)
        ->assertJson([
            'numero_conta' => '1235',
            'saldo' => '29.70',
        ]);
});

test('[POST] Create a valid transaction for PIX', function () {
    $this->seed([AccountSeeder::class, TransactionSeeder::class]);
    $response = $this->post(
        '/api/transacao', 
        ['forma_pagamento'=> 'P', 'numero_conta' => 1235, 'valor' => 10]
    );

    $response
        ->assertStatus(201)
        ->assertJson([
            'numero_conta' => '1235',
            'saldo' => '30.00',
        ]);
});
