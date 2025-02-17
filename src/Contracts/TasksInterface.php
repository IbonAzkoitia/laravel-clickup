<?php

declare(strict_types=1);

namespace IbonAzkoitia\LaravelClickup\Contracts;

interface TasksInterface
{
    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function create(string $listId, array $data): array;

    /**
     * @return array<string, mixed>
     */
    public function get(string $taskId): array;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function update(string $taskId, array $data): array;

    public function delete(string $taskId): bool;

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function list(string $listId, array $params = []): array;
}
