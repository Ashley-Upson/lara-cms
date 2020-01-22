<?php

namespace AshleyUpson\LaraCMS;

use AshleyUpson\LaraCMS\CMS;
use GrayDawesGroup\Travcom\Travcom;
use Illuminate\Support\ServiceProvider;

class CMSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config' => config('lara-cms'),
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/lara-cms.php', 'lara-cms'
        );

        //Facade
        $this->app->singleton('cms', function () {
            return new CMS();
        });

        $this->app->alias('cms', CMS::class);

        \Config::set('database.connections.travcom', [
            'driver' => 'mysql',
            'host' => config('travcom_invoicing.database.connections.travcom.host'),
            'database' => config('travcom_invoicing.database.connections.travcom.database'),
            'username' => config('travcom_invoicing.database.connections.travcom.username'),
            'password' => config('travcom_invoicing.database.connections.travcom.password'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        \Config::set('filesystems.disks.travcom_invoices', [
            'driver' => config('travcom_invoicing.disks.travcom_invoices.driver'),
            'root' => config('travcom_invoicing.disks.travcom_invoices.root'),
            'visibility' => config('travcom_invoicing.disks.travcom_invoices.visibility')
        ]);

        \Config::set('filesystems.disks.gpm', [
            'driver' => config('travcom_invoicing.disks.gpm.driver'),
            'host' => config('travcom_invoicing.disks.gpm.host'),
            'username' => config('travcom_invoicing.disks.gpm.username'),
            'password' => config('travcom_invoicing.disks.gpm.password'),
            'ssl' => config('travcom_invoicing.disks.gpm.ssl'),
            'port' => config('travcom_invoicing.disks.gpm.port'),
        ]);
    }
}