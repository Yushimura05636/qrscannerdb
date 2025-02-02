<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index']);
    Route::get('/{studentId}', [StudentController::class, 'show']);
    Route::post('/', [StudentController::class, 'store']);
    Route::put('/{studentId}', [StudentController::class, 'update']);
    Route::delete('/{studentId}', [StudentController::class, 'destroy']);
});

Route::get('/call/students', [StudentController::class, 'index']);

Route::get('/call/people', [PeopleController::class, 'index']);
Route::get('/call/people/{id}', [PeopleController::class, 'show']);
Route::post('/call/people', [PeopleController::class, 'store']);
Route::put('/call/people/{id}', [PeopleController::class, 'update']);
Route::delete('/call/people/{id}', [PeopleController::class, 'destroy']);

// Group history routes
Route::prefix('call')->group(function () {
    Route::get('/history', [HistoryController::class, 'index']);
    Route::get('/history/{id}', [HistoryController::class, 'show']);
    Route::post('/history', [HistoryController::class, 'store'])->name('history.store');
    Route::get('/history/scan/{id}', [HistoryController::class, 'historyScan']);
});

//authentication routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/user_login', [AuthController::class, 'user_login']);
Route::post('/user_logout', [AuthController::class, 'user_logout'])->middleware('auth:sanctum');
Route::post('/user_register', [AuthController::class, 'user_register']);
Route::post('/user_validation', [AuthController::class, 'user_validation']);
Route::post('/reset_password', [AuthController::class, 'reset_password']);
Route::post('/validate_forgot_password', [AuthController::class, 'validate_forgot_password']);
