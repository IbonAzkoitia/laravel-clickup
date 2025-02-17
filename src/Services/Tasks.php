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

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function list(string $listId, array $params = []): array
    {
        return $this->client->get("/list/{$listId}/task", $params);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function create(string $listId, array $data): array
    {
        return $this->client->post("/list/{$listId}/task", $data);
    }

    /**
     * @return array<string, mixed>
     */
    public function get(string $taskId): array
    {
        return $this->client->get("/task/{$taskId}");
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function update(string $taskId, array $data): array
    {
        return $this->client->put("/task/{$taskId}", $data);
    }

    public function delete(string $taskId): bool
    {
        return $this->client->delete("/task/{$taskId}");
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getFilteredTeamTasks(string $teamId, array $params = []): array
    {
        return $this->client->get("/team/{$teamId}/task", $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getTimeInStatus(string $taskId, array $params = []): array
    {
        return $this->client->get("/task/{$taskId}/time_in_status", $params);
    }

    /**
     * @param  array<string>  $taskIds
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getBulkTimeInStatus(array $taskIds, array $params = []): array
    {
        $taskIdsQuery = implode('&', array_map(fn (string $id): string => "task_ids={$id}", $taskIds));

        return $this->client->get("/task/bulk_time_in_status/task_ids?{$taskIdsQuery}", $params);
    }

    /**
     * @return array<string, mixed>
     */
    public function createFromTemplate(string $listId, string $templateId, string $taskName): array
    {
        return $this->client->post("/list/{$listId}/taskTemplate/{$templateId}", [
            'name' => $taskName,
        ]);
    }
}
