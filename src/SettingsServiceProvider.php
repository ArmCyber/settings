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
        $this->mergeConfigFrom(
            __DIR__.'/config.php',
            'settings'
        );
        $this->app->singleton('settings', function () {
            return JsonObject::init(config('settings.filename'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config.php' => config_path('settings.php'),
        ]);
        $this->commands([
            SettingsGet::class,
            SettingsSet::class,
            SettingsForget::class,
            SettingsFlush::class,
        ]);
    }
}
