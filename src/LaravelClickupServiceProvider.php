<?php

declare(strict_types=1);

namespace IbonAzkoitia\LaravelClickup;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelClickupServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-clickup')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(ClickUp::class, fn ($app): \IbonAzkoitia\LaravelClickup\ClickUp => new ClickUp(
            config('clickup.api_token'),
            config('clickup.base_url', 'https://api.clickup.com/api/v2')
        ));
    }
}
