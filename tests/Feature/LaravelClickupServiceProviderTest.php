<?php

declare(strict_types=1);

use IbonAzkoitia\LaravelClickup\ClickUp;

it('registers clickup singleton', function () {
    $clickup = app(ClickUp::class);

    expect($clickup)->toBeInstanceOf(ClickUp::class);
});

it('throws exception when api token is not string', function () {
    config(['clickup.api_token' => 123]);

    expect(fn () => app(ClickUp::class))
        ->toThrow(InvalidArgumentException::class, 'ClickUp API token must be a string');
});

it('throws exception when base url is not string', function () {
    config(['clickup.api_token' => 'valid-token']);
    config(['clickup.base_url' => 123]);

    expect(fn () => app(ClickUp::class))
        ->toThrow(InvalidArgumentException::class, 'ClickUp base URL must be a string');
});