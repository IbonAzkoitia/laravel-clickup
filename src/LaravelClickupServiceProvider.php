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
}
