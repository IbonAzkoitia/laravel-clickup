<?php

declare(strict_types=1);

namespace IbonAzkoitia\Clickup\Resources;

class SpaceResource
{
    public function __construct(
        private readonly array $data
    ) {}

    public static function collection(array $spaces): array
    {
        return array_map(fn (array $space): array => (new self($space))->toArray(), $spaces);
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
