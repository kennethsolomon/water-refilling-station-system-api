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
Route::post("create_transaction", [\App\Http\Controllers\TransactionController::class, 'create']);
Route::get("transactions", [\App\Http\Controllers\TransactionController::class, 'index']);

// Customer
Route::get("customers", [\App\Http\Controllers\CustomerController::class, 'index']);
Route::get("customer/{customer}", [\App\Http\Controllers\CustomerController::class, 'show']);
Route::post("create_or_update_customer", [\App\Http\Controllers\CustomerController::class, 'createOrUpdate']);
Route::delete("delete_customer/{customer}", [\App\Http\Controllers\CustomerController::class, 'destroy']);
