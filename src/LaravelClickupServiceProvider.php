<?php

declare(strict_types=1);

namespace IbonAzkoitia\LaravelClickup;

use Illuminate\Foundation\Application;
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
        $this->app->singleton(ClickUp::class, function (Application $app): ClickUp {
            $apiToken = config('clickup.api_token');
            $baseUrl = config('clickup.base_url', 'https://api.clickup.com/api/v2');

            if (! is_string($apiToken)) {
                throw new \InvalidArgumentException('ClickUp API token must be a string');
            }

            if (! is_string($baseUrl)) {
                throw new \InvalidArgumentException('ClickUp base URL must be a string');
            }

            return new ClickUp(
                $apiToken,
                $baseUrl
            );
        });
    }
}
