<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php83\Rector\ClassMethod\AddOverrideAttributeToOverriddenMethodsRector;
use Rector\Privatization\Rector\ClassMethod\PrivatizeFinalClassMethodRector;
use Rector\Privatization\Rector\MethodCall\PrivatizeLocalGetterToPropertyRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/config',
        __DIR__.'/src',
    ])
    ->withSkip([
        AddOverrideAttributeToOverriddenMethodsRector::class,
        // Skip privatization rules for Filament resource classes
        PrivatizeLocalGetterToPropertyRector::class => [
            __DIR__.'/app/Filament',
        ],
        PrivatizeFinalClassMethodRector::class => [
            __DIR__.'/app/Filament',
        ],
    ])
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        typeDeclarations: true,
        privatization: true,
        earlyReturn: true,
        strictBooleans: true,
    )
    ->withPhpSets();
