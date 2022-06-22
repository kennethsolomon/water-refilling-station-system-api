<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('/user', function (Request $request){
        return $request->user();
    });

    Route::get("register",[\App\Http\Controllers\AuthController::class,'register']);
    Route::post("logout",[\App\Http\Controllers\AuthController::class,'logout']);
});

    Route::post("login",[\App\Http\Controllers\AuthController::class,'login']);