<?php

use App\Http\Controllers\RequestController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users',UserController::class);
Route::apiResource('slides',SlideController::class);
Route::apiResource('requests', RequestController::class);
Route::get('TotalUsers', [UserController::class, 'countUsers']);
Route::get('getUserTypeByEmail', [UserController::class, 'getUserTypeByEmail']);
Route::put('accept_request',[RequestController::class,'acceptRequest']);
Route::put('reject_request',[RequestController::class,'rejectRequest']);
Route::put('update_request',[RequestController::class,'update']);
Route::delete('delete_request', [RequestController::class, 'destroy']);
