<?php

namespace IbonAzkoitia\LaravelClickup\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \IbonAzkoitia\LaravelClickup\LaravelClickup
 */
class LaravelClickup extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \IbonAzkoitia\LaravelClickup\LaravelClickup::class;
    }
}
