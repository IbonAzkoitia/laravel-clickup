<?php

declare(strict_types=1);

namespace IbonAzkoitia\Clickup;

use InvalidArgumentException;
use Override;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ClickupServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-clickup')
            ->hasConfigFile();
    }

    #[Override]
    public function packageRegistered()
    {
        $this->app->singleton(Clickup::class, function (): Clickup {
            $apiToken = config('clickup.api_token');
            $baseUrl = config('clickup.base_url');

            if (! is_string($apiToken)) {
                throw new InvalidArgumentException('The ClickUp API token must be a string');
            }

            if (! is_string($baseUrl)) {
                throw new InvalidArgumentException('The ClickUp base URL must be a string');
            }

            return new Clickup(
                $apiToken,
                $baseUrl,
            );

        });
    }
}
