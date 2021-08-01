<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/email'], function() {
    Route::group(['prefix' => '/templates'], function() {
        Route::get('/', 'EmailTemplatesController@index')->name('email.templates.index');
        Route::post('/', 'EmailTemplatesController@store')->name('email.templates.store');
    });
    Route::group(['prefix' => '/logs'], function() {
        Route::get('/', 'EmailLogsController@index')->name('email.logs.index');
        Route::post('/', 'EmailLogsController@store')->name('email.logs.store');
    });
});
