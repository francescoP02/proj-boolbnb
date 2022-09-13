<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('/apartments', 'ApartmentController');
        // Route::get('/apartments/{apartment}', 'ApartmentController@index')->name('messages.index');
        Route::get('/apartments/{apartment}/messages', 'MessageController@index')->name('messages.index');
        Route::get('/apartments/{apartment}/sponsor', 'PlanController@index')->name('sponsored.index');
        Route::post('/apartments/{apartment}/sponsor', 'PlanController@store')->name('sponsored.store');
    });

// Route::resource('messages', 'MessageController');

Route::get('admin/{any?}', function () {
    return view('admin.home');
})->where('any', '.*');


Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');
