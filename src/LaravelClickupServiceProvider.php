<?php

declare(strict_types=1);

namespace IbonAzkoitia\LaravelClickup;

use Illuminate\Support\ServiceProvider;

class LaravelClickupServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/clickup.php',
            'clickup'
        );

        $this->app->singleton(ClickUp::class, fn ($app): \IbonAzkoitia\LaravelClickup\ClickUp => new ClickUp(
            config('clickup.api_token'),
            config('clickup.base_url', 'https://api.clickup.com/api/v2')
        ));
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/clickup.php' => config_path('clickup.php'),
        ], 'clickup-config');
    }
}
