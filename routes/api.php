<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\User\UserController;
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

//Открытые Роуты Авторизации и регистрации
Route::group(['prefix' => 'auth'], function () {
    Route::post('register',     [AuthController::class, 'register']);
    Route::post('login',        [AuthController::class, 'login']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::post('{id}',    [UserController::class, 'update'])->middleware('checkAdminRole');
        Route::get('/',       [UserController::class, 'list'])->middleware('checkAdminRole');
        Route::get('{id}',    [UserController::class, 'read'])->middleware('checkAdminRole');;
        Route::delete('{id}', [UserController::class, 'delete'])->middleware('checkAdminRole');
    });

    Route::group(['prefix' => 'car'], function () {
        Route::put('{id}',    [CarController::class, 'upadate'])->middleware('checkAdminRole');
        Route::get('/',       [CarController::class, 'list']);
        Route::get('{id}',    [CarController::class, 'read'])->middleware('checkAdminRole');
        Route::delete('{id}', [CarController::class, 'delete'])->middleware('checkAdminRole');
    });

    Route::group(['prefix' => 'booking'], function () {
        Route::post('book/{id}',    [CarBookingController::class, 'book']);
        Route::post('cancel/{id}',  [CarBookingController::class, 'cancel']);
    });
});
