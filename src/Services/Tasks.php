<?php

declare(strict_types=1);

namespace IbonAzkoitia\LaravelClickup\Services;

use IbonAzkoitia\LaravelClickup\Contracts\TasksInterface;
use IbonAzkoitia\LaravelClickup\Http\Client;
use IbonAzkoitia\LaravelClickup\Resources\TaskResource;

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
        $response = $this->client->get("/list/{$listId}/task", $params);

        return [
            'tasks' => TaskResource::collection($response['tasks']),
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function create(string $listId, array $data): array
    {
        $response = $this->client->post("/list/{$listId}/task", $data);

        return (new TaskResource($response))->toArray();
    }

    /**
     * @return array<string, mixed>
     */
    public function get(string $taskId): array
    {
        $response = $this->client->get("/task/{$taskId}");

        return (new TaskResource($response))->toArray();
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
        // Convert task IDs array into query parameters format
        $queryParams = [];
        foreach ($taskIds as $taskId) {
            $queryParams['task_ids'][] = $taskId;
        }

        return $this->client->get('/task/bulk_time_in_status/task_ids', $queryParams);
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
