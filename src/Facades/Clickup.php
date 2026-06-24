<?php

declare(strict_types=1);

namespace IbonAzkoitia\Clickup\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \IbonAzkoitia\Clickup\Clickup
 */
class Clickup extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \IbonAzkoitia\Clickup\Clickup::class;
    }
}
