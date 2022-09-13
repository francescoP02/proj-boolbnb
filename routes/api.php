<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/apartments', 'Api\ApartmentController@showAll')->name('api.apartment.showAll');

Route::get('/{slug}', 'Api\ApartmentController@showOne')->name('api.apartment.showOne');

Route::post('/messages', 'Api\MessageController@store');

Route::middleware('api')
    ->prefix('admin')
    ->group(function () {
        Route::post('/messages', 'Api\MessageController@store');
        Route::get('/{slug}', 'Api\ApartmentController@showOne')->name('admin.apartment.showOne');
    });
