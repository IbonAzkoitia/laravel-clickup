<?php

declare(strict_types=1);

namespace IbonAzkoitia\LaravelClickup\Tests;

use Dotenv\Dotenv;
use IbonAzkoitia\LaravelClickup\LaravelClickupServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        // Load .env.testing file from the package directory
        if (file_exists(__DIR__.'/../.env.testing')) {
            (Dotenv::createImmutable(__DIR__.'/..', '.env.testing'))->load();
        }

        $this->ensureTestEnvironmentVariables();

        // Ensure configuration is set
        config([
            'clickup' => [
                'api_token' => env('CLICKUP_API_TOKEN'),
                'base_url' => env('CLICKUP_API_URL', 'https://api.clickup.com/api/v2'),
            ],
        ]);
    }

    private function ensureTestEnvironmentVariables(): void
    {
        if (! file_exists(__DIR__.'/../.env.testing')) {
            throw new \RuntimeException(
                'The .env.testing file is missing. Please copy .env.testing.example to .env.testing and add your test credentials.'
            );
        }

        $required = [
            'CLICKUP_API_TOKEN',
            'CLICKUP_TEST_LIST_ID',
            'CLICKUP_TEST_TEAM_ID',
            'CLICKUP_TEST_TASK_ID',
            'CLICKUP_TEST_TEMPLATE_ID',
        ];

        $missing = array_filter($required, function ($var) {
            $value = env($var);

            return empty($value) || $value === 'your_token_here' || str_contains($value, 'your_');
        });

        if (! empty($missing)) {
            throw new \RuntimeException(
                'Please update your .env.testing file with real test values for: '.
                implode(', ', $missing)."\n".
                'Copy .env.testing.example to .env.testing and replace the placeholder values with your actual test data.'
            );
        }
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelClickupServiceProvider::class,
        ];
    }
}
