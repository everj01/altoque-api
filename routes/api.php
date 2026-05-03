<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;

// Mobile (token)
Route::post('/login', [SessionController::class, 'loginMobile'])->middleware('throttle:login');

// Web (cookie)
Route::post('/web/login', [SessionController::class, 'loginWeb'])->middleware('throttle:login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/mfa/verify', [SessionController::class, 'verifyMfa']);
    Route::post('/mfa/setup', [SessionController::class, 'setupMfa']);
    Route::post('/mfa/confirm', [SessionController::class, 'confirmMfa']);

    Route::post('/logout', [SessionController::class, 'logout']);
    Route::post('/web/logout', [SessionController::class, 'logoutWeb']);
    Route::get('/me', [SessionController::class, 'me']);
});
