<?php

declare(strict_types=1);

namespace IbonAzkoitia\LaravelClickup\Resources;

/**
 * Task Resource
 *
 * Fields are ordered to match the ClickUp API documentation:
 *
 * @see https://developer.clickup.com/reference/gettasks
 */
class TaskResource
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
        return [
            'id' => $this->data['id'],
            'custom_id' => $this->data['custom_id'] ?? null,
            'name' => $this->data['name'],
            'text_content' => $this->data['text_content'] ?? '',
            'description' => $this->data['description'] ?? '',
            'status' => $this->formatStatus(),
            'orderindex' => $this->data['orderindex'] ?? '',
            'date_created' => $this->data['date_created'] ?? null,
            'date_updated' => $this->data['date_updated'] ?? null,
            'date_closed' => $this->data['date_closed'] ?? null,
            'date_done' => $this->data['date_done'] ?? null,
            'archived' => $this->data['archived'] ?? false,
            'creator' => $this->formatCreator(),
            'assignees' => $this->formatAssignees(),
            'watchers' => $this->formatWatchers(),
            'checklists' => $this->data['checklists'] ?? [],
            'tags' => $this->data['tags'] ?? [],
            'parent' => $this->data['parent'] ?? null,
            'priority' => $this->formatPriority(),
            'due_date' => $this->data['due_date'] ?? null,
            'start_date' => $this->data['start_date'] ?? null,
            'points' => $this->data['points'] ?? null,
            'time_estimate' => $this->data['time_estimate'] ?? null,
            'time_spent' => $this->data['time_spent'] ?? 0,
            'custom_fields' => $this->data['custom_fields'] ?? [],
            'dependencies' => $this->data['dependencies'] ?? [],
            'linked_tasks' => $this->data['linked_tasks'] ?? [],
            'team_id' => $this->data['team_id'] ?? '',
            'url' => $this->data['url'] ?? '',
            'permission_level' => $this->data['permission_level'] ?? '',
            'list' => $this->formatList(),
            'project' => $this->formatProject(),
            'folder' => $this->formatFolder(),
            'space' => $this->formatSpace(),
            'attachments' => $this->data['attachments'] ?? [],
            'subtasks' => $this->formatSubtasks(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function formatStatus(): array
    {
        $status = $this->data['status'] ?? [];

        return [
            'id' => $status['id'] ?? '',
            'status' => $status['status'] ?? '',
            'color' => $status['color'] ?? '',
            'orderindex' => $status['orderindex'] ?? 0,
            'type' => $status['type'] ?? '',
        ];
    }

    /**
     * @return array<string, mixed>|null
     */
    private function formatPriority(): ?array
    {
        if (! isset($this->data['priority'])) {
            return null;
        }

        $priority = $this->data['priority'];

        return [
            'id' => $priority['id'] ?? '',
            'priority' => $priority['priority'] ?? '',
            'color' => $priority['color'] ?? '',
            'orderindex' => $priority['orderindex'] ?? 0,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function formatCreator(): array
    {
        $creator = $this->data['creator'] ?? [];

        return [
            'id' => $creator['id'] ?? 0,
            'username' => $creator['username'] ?? '',
            'color' => $creator['color'] ?? '',
            'email' => $creator['email'] ?? '',
            'profile_picture' => $creator['profilePicture'] ?? null,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function formatAssignees(): array
    {
        return array_map(fn (array $assignee): array => [
            'id' => $assignee['id'] ?? 0,
            'username' => $assignee['username'] ?? '',
            'color' => $assignee['color'] ?? '',
            'initials' => $assignee['initials'] ?? '',
            'email' => $assignee['email'] ?? '',
            'profile_picture' => $assignee['profilePicture'] ?? null,
        ], $this->data['assignees'] ?? []);
    }

    /**
     * @return array<string, mixed>
     */
    private function formatWatchers(): array
    {
        return array_map(fn (array $watcher): array => [
            'id' => $watcher['id'] ?? 0,
            'username' => $watcher['username'] ?? '',
            'color' => $watcher['color'] ?? '',
            'initials' => $watcher['initials'] ?? '',
            'email' => $watcher['email'] ?? '',
            'profile_picture' => $watcher['profilePicture'] ?? null,
        ], $this->data['watchers'] ?? []);
    }

    /**
     * @return array<string, mixed>
     */
    private function formatList(): array
    {
        $list = $this->data['list'] ?? [];

        return [
            'id' => $list['id'] ?? '',
            'name' => $list['name'] ?? '',
            'access' => $list['access'] ?? false,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function formatProject(): array
    {
        $project = $this->data['project'] ?? [];

        return [
            'id' => $project['id'] ?? '',
            'name' => $project['name'] ?? '',
            'hidden' => $project['hidden'] ?? false,
            'access' => $project['access'] ?? false,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function formatFolder(): array
    {
        $folder = $this->data['folder'] ?? [];

        return [
            'id' => $folder['id'] ?? '',
            'name' => $folder['name'] ?? '',
            'hidden' => $folder['hidden'] ?? false,
            'access' => $folder['access'] ?? false,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function formatSpace(): array
    {
        $space = $this->data['space'] ?? [];

        return [
            'id' => $space['id'] ?? '',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function formatSubtasks(): array
    {
        return array_map(fn (array $subtask): array => (new self($subtask))->toArray(), $this->data['subtasks'] ?? []);
    }

    /**
     * @param  array<array-key, mixed>  $tasks
     * @return array<string, mixed>
     */
    public static function collection(array $tasks): array
    {
        return array_map(fn (array $task): array => (new self($task))->toArray(), $tasks);
    }
}
