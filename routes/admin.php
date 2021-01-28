<?php

Auth::routes();
Route::group(['prefix' => 'admin'], function() {
    Route::get('/login', 'App\Http\Controllers\LoginController@showLogin')->name('show-login');
    Route::post('login', 'App\Http\Controllers\LoginController@login');
    Route::get('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth:admin']], function() {
    Route::get('/', function () {
        return view('dashboard');
    })->name('admin');
});

});
