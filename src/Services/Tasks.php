<?php

declare(strict_types=1);

namespace IbonAzkoitia\LaravelClickup\Services;

use IbonAzkoitia\LaravelClickup\Contracts\TasksInterface;
use IbonAzkoitia\LaravelClickup\Http\Client;

class Tasks implements TasksInterface
{
    public function __construct(
        private readonly Client $client
    ) {}

    public function create(string $listId, array $data): array
    {
        return $this->client->post("/list/{$listId}/task", $data);
    }

    public function get(string $taskId): array
    {
        return $this->client->get("/task/{$taskId}");
    }

    public function update(string $taskId, array $data): array
    {
        return $this->client->put("/task/{$taskId}", $data);
    }

    public function delete(string $taskId): bool
    {
        $this->client->delete("/task/{$taskId}");

        return true;
    }

    public function list(string $listId, array $params = []): array
    {
        return $this->client->get("/list/{$listId}/task", $params);
    }
}
