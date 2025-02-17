<?php

declare(strict_types=1);

namespace IbonAzkoitia\LaravelClickup\Contracts;

interface TasksInterface
{
    /**
     * Get tasks from a specific list
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function list(string $listId, array $params = []): array;

    /**
     * Create a task in a specific list
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function create(string $listId, array $data): array;

    /**
     * Get a task by its ID
     *
     * @return array<string, mixed>
     */
    public function get(string $taskId): array;

    /**
     * Update a task by its ID
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function update(string $taskId, array $data): array;

    /**
     * Delete a task by its ID
     */
    public function delete(string $taskId): bool;

    /**
     * Get filtered tasks from a specific team
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getFilteredTeamTasks(string $teamId, array $params = []): array;

    /**
     * Get one task time in Status
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getTimeInStatus(string $taskId, array $params = []): array;

    /**
     * Get bukl tasks time in Status
     *
     * @param  array<string>  $taskIds
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getBulkTimeInStatus(array $taskIds, array $params = []): array;

    /**
     * Create task from Template
     *
     * @return array<string, mixed>
     */
    public function createFromTemplate(string $listId, string $templateId, string $taskName): array;
}
