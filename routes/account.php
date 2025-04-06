<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AccountController;

Route::post('/conta', [AccountController::class, 'store']);
Route::get('/conta', [AccountController::class, 'show']);
 