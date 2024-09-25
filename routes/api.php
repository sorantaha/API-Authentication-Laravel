<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\UserController;

Route::prefix( prefix: 'v1')->group(function (){
    Route::post ( '/signIn', [AuthController::class,'signIn']);
    Route::post( '/signUp', [AuthController::class,'signUp']);

    Route::middleware('auth:sanctum')->group(function (){
        Route::get('/test', action: [UserController::class,'testToken']);
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
