<?php

declare(strict_types=1);

namespace IbonAzkoitia\LaravelClickup\Resources;

/**
 * Space Resource
 *
 * Fields are ordered to match the ClickUp API documentation:
 *
 * @see https://developer.clickup.com/reference/getspaces
 */
class SpaceResource
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        private readonly array $data
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * @param  array<array-key, mixed>  $spaces
     * @return array<string, mixed>
     */
    public static function collection(array $spaces): array
    {
        return array_map(fn (array $space): array => (new self($space))->toArray(), $spaces);
    }
}
