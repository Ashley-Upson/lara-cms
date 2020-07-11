<?php

namespace LaraCMS;

use Illuminate\Support\ServiceProvider;

class CMSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/lara-cms.php' => config_path('lara-cms.php'),
        ]);

        $this->mergeConfigFrom(__DIR__ . '/config/lara-cms.php', 'lara-cms');

        $this->loadRoutesFrom(__DIR__ . '/routes/cms.php');

        $this->loadMigrationsFrom(__DIR__ . '/migrations');

        $this->loadViewsFrom(__DIR__ . '/views', 'laracms');
    }

    public function register()
    {
//        $this->mergeConfigFrom(
//            __DIR__ . '/config/lara-cms.php', 'lara-cms'
//        );
    }
}