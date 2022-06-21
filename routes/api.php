<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Register
Route::get('register', function(Request $request){
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);

    return $user;
});

// login
Route::post('login', function(Request $request){
    $credentials = $request->only('email', 'password');

    if(! auth()->attempt($credentials)){
        throw ValidationException::withMessages([
            'email' => 'Invalid credentials'
        ]);
    }

    $request->session()->regenerate();

    return response()->json(null, 201);
});

// logout
Route::post('logout', function(Request $request){
    auth()->guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return response()->json(null, 200);
});