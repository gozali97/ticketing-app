<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('events', [\App\Http\Controllers\Api\EventController::class, 'index']);
    Route::get('events/detail/{id}', [\App\Http\Controllers\Api\EventController::class, 'show']);
    Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});
