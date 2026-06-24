<?php

namespace IbonAzkoitia\Clickup\Tests;

<<<<<<< HEAD
use IbonAzkoitia\LaravelClickup\LaravelClickupServiceProvider;
=======
use IbonAzkoitia\Clickup\ClickupServiceProvider;
>>>>>>> fb17f90 (change name from LaravelClickup to Clickup)
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'IbonAzkoitia\\Clickup\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            ClickupServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/../database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */
    }
}
