<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\ProductsController;



Route::get('/', function (Response $response) {
    return json_encode(["status" => " Running || Active"]);
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth Routes

Route::middleware(['authAPI'])->group(function(){

    // Users routes
    Route::get('/user/{id}', [UsersController::class, 'index']);
    Route::get('/users', [UsersController::class, 'show']);
    Route::post('/users', [UsersController::class, 'store']);
    Route::put('/user/{id}', [UsersController::class, 'update']);
    Route::delete('/user/{id}', [UsersController::class, 'delete']);
    
    // Providers Routes
    Route::get('/provider/{id}', [ProvidersController::class, 'index']);
    Route::get('/providers', [ProvidersController::class, 'show']);
    Route::post('/provider', [ProvidersController::class, 'store']);
    Route::put('/provider/{id}', [ProvidersController::class, 'update']);
    Route::delete('/provider/{id}', [ProvidersController::class, 'delete']);
    
    // Products Routes
    Route::get('/product/{id}', [ProductsController::class, 'index']);
    Route::get('/products', [ProductsController::class, 'show']);
    Route::post('/product', [ProductsController::class, 'store']);
    Route::put('/product/{id}', [ProductsController::class, 'update']);
    Route::delete('/product/{id}', [ProductsController::class, 'delete']);
    
    // Stock Routes

    //logout
    Route::get('/logout', [AuthController::class, 'destroy']);
});
