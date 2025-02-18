<?php

namespace IbonAzkoitia\LaravelClickup\Tests\Unit\Http;

use IbonAzkoitia\LaravelClickup\ClickUp;
use IbonAzkoitia\LaravelClickup\Exceptions\AuthenticationException;
use IbonAzkoitia\LaravelClickup\Exceptions\ClickUpException;
use IbonAzkoitia\LaravelClickup\Exceptions\RateLimitException;
use IbonAzkoitia\LaravelClickup\Http\Client;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->apiToken = config('clickup.api_token');
    $this->baseUrl = 'https://api.clickup.com/api/v2';
    $this->listId = env('CLICKUP_TEST_LIST_ID');
});

it('throws authentication exception on 401 response', function () {
    $this->clickup = new ClickUp(
        apiToken: 'test-token',
        baseUrl: $this->baseUrl
    );

    Http::fake(function ($request) {
        if ($request->url() === $this->baseUrl.'/list/'.$this->listId.'/task') {
            return Http::response([], 401);
        }
    });

    $this->clickup->tasks()->list($this->listId);
})->throws(AuthenticationException::class, 'Invalid authentication credentials');

