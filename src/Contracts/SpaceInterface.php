<?php

declare(strict_types=1);

namespace IbonAzkoitia\LaravelClickup\Contracts;

interface SpaceInterface
{
    /**
     * Get spaces from a specific team
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function list(string $teamId, array $params = []): array;

    /**
     * Create a space in a specific team
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    // public function create(string $teamId, array $data): array;

    /**
     * Get a space by its ID
     *
     * @return array<string, mixed>
     */
    // public function get(string $spaceId): array;

    /**
     * Update a space by its ID
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    // public function update(string $spaceId, array $data): array;

    /**
     * Delete a space by its ID
     */
    // public function delete(string $spaceId): bool;
}
