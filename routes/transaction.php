<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionController;

Route::post('/transacao', [TransactionController::class, 'store']);
 