<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;

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
Route::prefix('/v1')->as('api.v1')->group(function() {
    Route::prefix('/auth')->as('.auth')->group(function() {
        Route::post('/login', [AuthController::class, 'login'])->name('.login');

        Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout'])->name('.logout');
    });

    Route::group([
        'middleware' => 'auth:api',
    ], function() {
        Route::get('/user', function (Request $request) {
            return $request->user();
        })->name('.user');
    });
});


