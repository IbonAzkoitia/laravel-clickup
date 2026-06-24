<?php

declare(strict_types=1);

namespace IbonAzkoitia\Clickup\Contracts;

interface SpaceInterface
{
    public function list(?array $params = []): array;
}
