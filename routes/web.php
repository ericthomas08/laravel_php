<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::pattern('id', '[0-9]+');

Route::group([], function () {
    Route::get('/',             ['as' => 'customer.auth',           'uses' => 'CustomerController@index']);
    Route::get('login',         ['as' => 'customer.auth.login',     'uses' => 'CustomerController@login']);
    Route::get('register',      ['as' => 'customer.auth.create',    'uses' => 'CustomerController@create']);
    Route::post('doLogin',      ['as' => 'customer.auth.doLogin',   'uses' => 'CustomerController@doLogin']);
    Route::post('doRegister',   ['as' => 'customer.auth.doRegister','uses' => 'CustomerController@doRegister']);
});

Route::group(['middleware' => ['customer-auth']], function () {
    Route::group(['prefix' => 'booking'], function () {
        Route::get('/',                     ['as' => 'customer.booking',          'uses' => 'BookingController@index']);
        Route::get('create',                ['as' => 'customer.booking.create',   'uses' => 'BookingController@create']);
        Route::post('store',                ['as' => 'customer.booking.store',    'uses' => 'BookingController@store']);
        Route::delete('delete/{id}',        ['as' => 'customer.booking.delete',   'uses' => 'BookingController@destroy']);
    });

    Route::get('doLogout',                  ['as' => 'customer.auth.doLogout',      'uses' => 'CustomerController@doLogout']);
});



//Route::resource('customer', 'CustomerController');
//Route::resource('booking', 'BookingController');
//Route::resource('cleaner', 'CleanerController');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/',         ['as' => 'admin.auth',         'uses' => 'Admin\AdminController@index']);
    Route::get('login',     ['as' => 'admin.auth.login',   'uses' => 'Admin\AdminController@login']);
    Route::post('doLogin',  ['as' => 'admin.auth.doLogin', 'uses' => 'Admin\AdminController@doLogin']);
});


Route::group(['prefix' => 'admin', 'middleware' => ['admin-auth']], function () {
    Route::get('doLogout',                  ['as' => 'admin.auth.doLogout', 'uses' => 'Admin\AdminController@doLogout']);

    Route::group(['prefix' => 'city'], function () {
        Route::get('/',                     ['as' => 'admin.city',          'uses' => 'Admin\CityController@index']);
        Route::get('create',                ['as' => 'admin.city.create',   'uses' => 'Admin\CityController@create']);
        Route::delete('delete/{id}',        ['as' => 'admin.city.delete',   'uses' => 'Admin\CityController@destroy']);
        Route::post('store',                ['as' => 'admin.city.store',    'uses' => 'Admin\CityController@store']);
    });

    Route::group(['prefix' => 'cleaner'], function () {
        Route::get('/',                     ['as' => 'admin.cleaner',          'uses' => 'Admin\CleanerController@index']);
        Route::get('create',                ['as' => 'admin.cleaner.create',   'uses' => 'Admin\CleanerController@create']);
        Route::get('edit/{id}',             ['as' => 'admin.cleaner.edit',     'uses' => 'Admin\CleanerController@edit']);
        Route::delete('delete/{id}',        ['as' => 'admin.cleaner.delete',   'uses' => 'Admin\CleanerController@destroy']);
        Route::post('store',                ['as' => 'admin.cleaner.store',    'uses' => 'Admin\CleanerController@store']);
        Route::post('update/{id}',          ['as' => 'admin.cleaner.update',   'uses' => 'Admin\CleanerController@update']);
        Route::get('view/{id}',             ['as' => 'admin.cleaner.view',     'uses' => 'Admin\CleanerController@show']);
    });

    Route::group(['prefix' => 'customer'], function () {
        Route::get('/',                     ['as' => 'admin.customer',         'uses' => 'Admin\CustomerController@index']);
        Route::get('/view/{id}',            ['as' => 'admin.customer.view',    'uses' => 'Admin\CustomerController@show']);
    });

});