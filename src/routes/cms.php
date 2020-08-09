<?php

// CMS admin routing.

Route::namespace('LaraCMS\Controllers')->as('laracms::')->middleware([
    'web',
])->group(function() {
//    Route::prefix('admin')->middleware('admin')->group(function() {
    Route::prefix('admin')->namespace('Admin')->middleware([
        'LaraCMS\Middleware\Authenticated',
        'LaraCMS\Middleware\CheckUserIsAdmin'
    ])->group(function() {
        Route::get('/', 'AdminController@index')->name('get.admin');

        Route::resource('pages', 'PageController', [
            'names' => [
                'index' => 'get.admin/pages/index',
                'create' => 'get.admin/pages/create',
                'store' => 'post.admin/pages/store',
                'edit' => 'get.admin/pages/edit',
                'update' => 'put.admin/pages/update',
                'destroy' => 'delete.admin/pages/delete'
            ]
        ])->except(['show']);

        Route::resource('pages/{page}/content', 'ContentController', [
            'names' => [
                'create' => 'get.admin/pages/content/create',
                'store' => 'post.admin/pages/content/store',
                'edit' => 'get.admin/pages/content/edit',
                'update' => 'put.admin/pages/content/update',
                'delete' => 'delete.admin/pages/content/delete',
            ]
        ])->except(['show']);
    });

    // Standard CMS routes.
    Route::get(config('lara-cms.page_prefix') . '{page}', 'PageController@show')->name('get.page');

    Route::prefix('auth')->namespace('Auth')->group(function() {
        Route::get('login', 'AuthController@viewLogin')->name('get.auth/login');
        Route::post('login', 'AuthController@login')->name('post.auth/login');

        Route::get('register', 'AuthController@viewRegister')->name('get.auth/register');
        Route::post('register', 'AuthController@register')->name('post.auth/register');

        Route::get('logout', 'AuthController@logout')->name('get.auth/logout');
    });

    foreach(\LaraCMS\LaraCMS::getPublishedCustomRoutes() as $route) {
        if($route->page_id != null) {
            Route::{$route->request_method}($route->custom_route, [
                'uses' => 'PageController@show',
                'page' => $route->page_id
            ])->name('get.' . $route->custom_route);
        } else {
            Route::{$route->request_method}($route->custom_route, '\App\Http\Controllers\\' . $route->custom_handler)->name($route->request_method . '.' . $route->custom_route);
        }
    }

    Route::middleware('LaraCMS\Middleware\CheckUserIsAdmin')->group(function() {
        foreach(\LaraCMS\LaraCMS::getUnpublishedCustomRoutes() as $route) {
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
});


