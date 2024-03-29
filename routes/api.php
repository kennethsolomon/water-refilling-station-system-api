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


// Transactions
Route::post("update_or_create_transaction", [\App\Http\Controllers\TransactionController::class, 'updateOrCreateTransaction']);
Route::get("transactions", [\App\Http\Controllers\TransactionController::class, 'index']);
Route::delete("delete_transaction/{transaction}", [\App\Http\Controllers\TransactionController::class, 'destroy']);

// Customer
Route::get("customers", [\App\Http\Controllers\CustomerController::class, 'index']);
Route::get("customer/{customer}", [\App\Http\Controllers\CustomerController::class, 'show']);
Route::get("customer_transactions/{customer}", [\App\Http\Controllers\CustomerController::class, 'showCustomerTransactions']);
Route::get("customer_borrow_items/{customer}", [\App\Http\Controllers\CustomerController::class, 'showCustomerBorrowItems']);
Route::get("customer_total_borrow_items/{customer}", [\App\Http\Controllers\CustomerController::class, 'showCustomerTotalBorrowItems']);
Route::post("update_or_create_customer", [\App\Http\Controllers\CustomerController::class, 'updateOrCreateCustomer']);
Route::delete("delete_customer/{customer}", [\App\Http\Controllers\CustomerController::class, 'destroy']);

// Employee
Route::get("employees", [\App\Http\Controllers\EmployeeController::class, 'index']);

// Item
Route::get("items", [\App\Http\Controllers\ItemController::class, 'index']);
Route::get("item/{item}", [\App\Http\Controllers\ItemController::class, 'show']);
Route::post("update_or_create_item", [\App\Http\Controllers\ItemController::class, 'updateOrCreateItem']);
Route::delete("delete_item/{item}", [\App\Http\Controllers\ItemController::class, 'destroy']);

// Expense
Route::post("create_expense", [\App\Http\Controllers\ExpenseController::class, 'createExpense']);
Route::delete("delete_item/{expense}", [\App\Http\Controllers\ExpenseController::class, 'destroy']);

// Borrow
Route::post("return_item/{borrow}", [\App\Http\Controllers\BorrowController::class, 'returnItem']);

Route::post("login", [\App\Http\Controllers\AuthController::class, 'login']);

// Route::get("getAllPlayers", [\App\Http\Controllers\PlayerController::class, 'getAllPlayers']);

// Route::post("setGameConfig", [\app\http\controllers\gamecontroller::class, 'setGameConfig']);
// Route::get("getGameConfig", [\App\Http\Controllers\GameController::class, 'getGameConfig']);
