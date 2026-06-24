<?php

namespace IbonAzkoitia\LaravelClickup;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use IbonAzkoitia\LaravelClickup\Commands\LaravelClickupCommand;

class LaravelClickupServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-clickup')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_clickup_table')
            ->hasCommand(LaravelClickupCommand::class);
    }
}
