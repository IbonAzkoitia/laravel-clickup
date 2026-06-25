<?php

namespace IbonAzkoitia\Clickup\Tests;

use Dotenv\Dotenv;
use IbonAzkoitia\Clickup\ClickupServiceProvider;
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

        if (file_exists(__DIR__.'/../.env')) {
            Dotenv::createImmutable(__DIR__.'/..')->safeLoad();

            $app['config']->set('clickup.api_token', env('CLICKUP_API_TOKEN', ''));
            $app['config']->set('clickup.base_url', env('CLICKUP_API_URL', config('clickup.base_url')));
            $app['config']->set('clickup.workspace_id', env('CLICKUP_WORKSPACE_ID', config('clickup.workspace_id')));
            $app['config']->set('clickup.test.space_id', env('CLICKUP_TEST_SPACE_ID'));
            $app['config']->set('clickup.test.folder_id', env('CLICKUP_TEST_FOLDER_ID'));
            $app['config']->set('clickup.test.list_id', env('CLICKUP_TEST_LIST_ID'));
        }

        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/../database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */
    }
}
