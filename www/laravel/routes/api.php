<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiControllers\UserController as ApiUserController;
use App\Http\Controllers\ApiControllers\CarController as ApiCarController;

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

Route::group(
    ['prefix' => 'v1', 'middleware' => 'throttle:120,1'],
    function () {
        Route::group(
            ['namespace' => 'ApiControllers', 'middleware' => ['pageValidation']],
            function () {
                Route::group(['prefix' => 'users'], function () {
                    Route::get('', [ApiUserController::class, 'index']);
                    Route::get('show', [ApiUserController::class, 'show']);
                });

                Route::group(['prefix' => 'cars'], function () {
                    Route::get('', [ApiCarController::class, 'index']);
                    Route::get('show', [ApiCarController::class, 'show']);
                });
            }
        );
    }
);
