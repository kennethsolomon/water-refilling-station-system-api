<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get("register", [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post("logout", [\App\Http\Controllers\AuthController::class, 'logout']);
});


// Route::post("login", [\App\Http\Controllers\AuthController::class, 'login']);

// Route::get("getAllPlayers", [\App\Http\Controllers\PlayerController::class, 'getAllPlayers']);

// Route::post("setGameConfig", [\app\http\controllers\gamecontroller::class, 'setGameConfig']);
// Route::get("getGameConfig", [\App\Http\Controllers\GameController::class, 'getGameConfig']);


// Transactions
Route::post("update_or_create_transaction", [\App\Http\Controllers\TransactionController::class, 'updateOrCreateTransaction']);
Route::get("transactions", [\App\Http\Controllers\TransactionController::class, 'index']);

// Customer
Route::get("customers", [\App\Http\Controllers\CustomerController::class, 'index']);
Route::get("customer/{customer}", [\App\Http\Controllers\CustomerController::class, 'show']);
Route::get("customer_transactions/{customer}", [\App\Http\Controllers\CustomerController::class, 'showCustomerTransactions']);
Route::post("update_or_create_customer", [\App\Http\Controllers\CustomerController::class, 'updateOrCreateCustomer']);
Route::delete("delete_customer/{customer}", [\App\Http\Controllers\CustomerController::class, 'destroy']);
