<?php

// CMS admin routing.

Route::namespace('AshleyUpson\LaraCMS\Controllers')->as('laracms::')->middleware('web', 'auth')->group(function() {
//    Route::prefix('admin')->middleware('admin')->group(function() {
    Route::prefix('admin')->namespace('Admin')->middleware([
        'AshleyUpson\LaraCMS\Middleware\Authenticated',
        'AshleyUpson\LaraCMS\Middleware\CheckUserIsAdmin'
    ])->group(function() {
        Route::get('/', 'AdminController@index')->name('get.admin');

        Route::prefix('pages')->group(function() {
            Route::get('/', 'PageController@index')->name('get.admin/pages/index');
            Route::get('create', 'PageController@create')->name('get.admin/pages/create');
            Route::post('store', 'PageController@store')->name('post.admin/pages/store');
        });
    });

    // Standard CMS routes.
    Route::get('page/{page}', 'PageController@show')->name('get.page');

    Route::prefix('auth')->namespace('Auth')->group(function() {
        Route::get('login', 'AuthController@viewLogin')->name('get.auth/login');
        Route::post('login', 'AuthController@login')->name('post.auth/login');

        Route::get('register', 'AuthController@viewRegister')->name('get.auth/register');
        Route::post('register', 'AuthController@register')->name('post.auth/register');
    });

    foreach(\AshleyUpson\LaraCMS\LaraCMS::getCustomRoutes() as $route) {
        if($route->page_id != null) {
            Route::{$route->request_method}($route->custom_route, [
                'uses' => 'PageController@show',
                'page' => $route->page_id
            ])->name('get.' . $route->custom_route);
        } else {
            Route::{$route->request_method}($route->custom_route, '\App\Http\Controllers\\' . $route->custom_handler)->name($route->request_method . '.' . $route->custom_route);
        }
    }
});


