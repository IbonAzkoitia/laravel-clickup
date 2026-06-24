<?php

namespace IbonAzkoitia\Clickup;

use IbonAzkoitia\Clickup\Commands\ClickupCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ClickupServiceProvider extends PackageServiceProvider
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
            ->hasConfigFile();
        // ->hasViews()
        // ->hasMigration('create_clickup_table')
        // ->hasCommand(ClickupCommand::class);
    }
}
