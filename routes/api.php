<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//auth page
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->prefix('auth')->group(function () {
    //================================== Get User =============================================================
    Route::get('/users', [UserController::class, 'getAll']);
    Route::get('/users/name', [UserController::class, 'getByName']);
    Route::get('/users/nim', [UserController::class, 'getByNim']);
    Route::get('/users/date', [UserController::class, 'getByDate']);

    //================================== Profile ==============================================================
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::put('/profile/update', [ProfileController::class, 'update']);
    Route::get('/profile/delete', [ProfileController::class, 'delete']);
    Route::post('/profile/logout', [AuthController::class, 'logout']);
});
