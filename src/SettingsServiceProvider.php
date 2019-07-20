<?php

namespace Zakhayko\Settings;

use Illuminate\Support\ServiceProvider;
use Zakhayko\Settings\Commands\SettingsFlush;
use Zakhayko\Settings\Commands\SettingsForget;
use Zakhayko\Settings\Commands\SettingsGet;
use Zakhayko\Settings\Commands\SettingsSet;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('settings', function () {
            return Valuestore::make(storage_path('app/settings.json'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            SettingsGet::class,
            SettingsSet::class,
            SettingsForget::class,
            SettingsFlush::class,
        ]);
    }
}
