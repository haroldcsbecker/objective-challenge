<?php

use Database\Seeders\AccountSeeder;

test('[GET] validation for a bad get call', function () {
    $response = $this->get('/api/conta');

    $response->assertInvalid([
        'numero_conta' => 'The numero conta field is required.',
    ]);
});

test('[GET] account seeding is functional', function () {
    $this->seed(AccountSeeder::class);
    $this->assertDatabaseCount('accounts', 1);
    $this->assertDatabaseHas('accounts', [
        'numero_conta' => "1235",
        'saldo' => 40
    ]);
});

test('[GET] account is not found', function () {
    $this->seed(AccountSeeder::class);

    $response = $this->get('/api/conta?numero_conta=1');
 
    $response
        ->assertStatus(404)
        ->assertJson(['message' => 'Account not found.']);
});

test('[GET] getting a valid account', function () {
    $this->seed(AccountSeeder::class);

    $response = $this->get('/api/conta?numero_conta=1235');
 
    $response
        ->assertStatus(200)
        ->assertJson([
            'numero_conta' => '1235',
            'saldo' => 40,
        ]);
});

test('[POST] validation for a duplicated account error', function () {
    $this->seed(AccountSeeder::class);
    $response = $this->post('/api/conta', ['numero_conta' => 1235, 'saldo' => 1]);

    $response->assertInvalid([
        'numero_conta' => 'The numero conta has already been taken.'
    ]);
});

test('[POST] validation for a valid account ballance', function () {
    $response = $this->post('/api/conta', ['numero_conta' => 1, 'saldo' => -1]);

    $response->assertInvalid([
        'saldo' => 'The saldo field must be greater than 0.'
    ]);
});

test('[POST] validation for a empty body post call', function () {
    $response = $this->post('/api/conta', []);

    $response->assertInvalid([
        'numero_conta' => 'The numero conta field is required.',
        'saldo' => 'The saldo field is required.',
    ]);
});

test('[POST] creating a valid account', function () {

    $response = $this->post('/api/conta', ['numero_conta' => '666', 'saldo' => 5 ]);
 
    $response
        ->assertStatus(201)
        ->assertJson([
            'numero_conta' => '666',
            'saldo' => 5,
        ]);
});
