<?php

declare(strict_types=1);

namespace IbonAzkoitia\LaravelClickup\Contracts;

interface TasksInterface
{
    public function create(string $listId, array $data): array;

    public function get(string $taskId): array;

    public function update(string $taskId, array $data): array;

    public function delete(string $taskId): bool;

    public function list(string $listId, array $params = []): array;
}
