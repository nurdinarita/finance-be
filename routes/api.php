<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\AccountBook\AccountBookController;
use App\Http\Controllers\Api\Member\MemberController;

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected route (harus login)
Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Account Book
    Route::get('/account-books', [AccountBookController::class, 'index']);
    Route::post('/account-books', [AccountBookController::class, 'store']);


    // Members
    Route::get('/members', [MemberController::class, 'index']);
    Route::post('/members', [MemberController::class, 'store']);
});

