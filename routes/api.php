<?php

use App\Http\Controllers\MerchantController;
use App\Http\Controllers\TransactoinsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::get('monthly-omzet', [TransactoinsController::class, 'monthlyOmzet'])->middleware('jwt.verify');
Route::get('monthly-omzet-outlet', [TransactoinsController::class, 'monthlyOmzetOutlet'])->middleware('jwt.verify');
Route::get('user', [UserController::class, 'getAuthenticatedUser'])->middleware('jwt.verify');
