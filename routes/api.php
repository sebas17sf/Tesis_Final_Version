<?php

use Illuminate\Http\Request;
use App\Http\Controllers\APISController;
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

 Route::get('/user/{id}', [APISController::class, 'getUserData']);

 Route::get('/user/{id}/role', [APISController::class, 'getUserRole']);

 Route::get('/logout', [APISController::class, 'logout']);

    Route::get('/estudiantes', [APISController::class, 'getEstudiantes']);
