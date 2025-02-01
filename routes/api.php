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

Route::get('/call/history', [HistoryController::class, 'index']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
