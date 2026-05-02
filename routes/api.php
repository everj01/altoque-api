<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;

Route::post('/login', [SessionController::class, 'login'])->middleware('throttle:login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/mfa/verify', [SessionController::class, 'verifyMfa']);
    Route::post('/mfa/setup', [SessionController::class, 'setupMfa']);
    Route::post('/mfa/confirm', [SessionController::class, 'confirmMfa']);
    
    Route::post('/logout', [SessionController::class, 'logout']);
    Route::get('/me', [SessionController::class, 'me']);
});
