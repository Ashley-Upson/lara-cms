<?php

// CMS admin routing.

Route::namespace('LaraCMS\Controllers')->as('laracms::')->middleware('web')->group(function() {
//    Route::prefix('admin')->middleware('admin')->group(function() {
    Route::prefix('admin')->namespace('Admin')->middleware([
        'LaraCMS\Middleware\Authenticated',
        'LaraCMS\Middleware\CheckUserIsAdmin'
    ])->group(function() {
        Route::get('/', 'AdminController@index')->name('get.admin');

        Route::resource('pages', 'PageController', [
            'names' => [
                'index' => 'get.admin/pages/index',
                'show' => 'get.admin/pages/show',
                'create' => 'get.admin/pages/create',
                'store' => 'post.admin/pages/store',
                'edit' => 'get.admin/pages/edit',
                'update' => 'put.admin/pages/update',
                'destroy' => 'delete.admin/pages/delete'
            ]
        ]);
    });

    // Standard CMS routes.
    Route::get('page/{page}', 'PageController@show')->name('get.page');

    Route::prefix('auth')->namespace('Auth')->group(function() {
        Route::get('login', 'AuthController@viewLogin')->name('get.auth/login');
        Route::post('login', 'AuthController@login')->name('post.auth/login');

        Route::get('register', 'AuthController@viewRegister')->name('get.auth/register');
        Route::post('register', 'AuthController@register')->name('post.auth/register');

        Route::get('logout', 'AuthController@logout')->name('get.auth/logout');
    });

    foreach(\LaraCMS\LaraCMS::getCustomRoutes() as $route) {
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


