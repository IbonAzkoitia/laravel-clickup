<?php

namespace IbonAzkoitia\LaravelClickup\Tests;

uses(TestCase::class)->in('Feature', 'Unit');

expect()->extend('toBeTask', function () {
    return $this->toBeArray()
        ->toHaveKeys(['id', 'name']);
});
