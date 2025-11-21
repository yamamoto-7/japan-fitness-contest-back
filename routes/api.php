<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\EventController as AdminEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;

// 公開側
Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{id}', [EventController::class, 'show']);

// 管理側
Route::prefix('admin')->group(function () {
  Route::post('/login',  [AuthController::class, 'login']);
  Route::post('/refresh',[AuthController::class, 'refresh']);

  Route::middleware('auth:admin')->group(function () {
    Route::get('/me',     [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class, 'logout']);

    // 大会登録
    Route::post('/events', [AdminEvent::class, 'store']);
  });
});
