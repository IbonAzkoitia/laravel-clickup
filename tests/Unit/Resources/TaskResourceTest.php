<?php

use IbonAzkoitia\LaravelClickup\Resources\TaskResource;

it('formats task data correctly with all fields', function () {
    $taskData = [
        'id' => '123',
        'custom_id' => 'TASK-123',
        'name' => 'Test Task',
        'text_content' => 'Test content',
        'description' => 'Test description',
        'status' => [
            'id' => 'status_1',
            'status' => 'in_progress',
            'color' => '#ff0000',
            'orderindex' => 1,
            'type' => 'custom',
        ],
        'orderindex' => '1',
        'date_created' => '1234567890',
        'date_updated' => '1234567891',
        'date_closed' => '1234567892',
        'date_done' => '1234567893',
        'archived' => true,
        'creator' => [
            'id' => 456,
            'username' => 'testuser',
            'color' => '#00ff00',
            'email' => 'test@example.com',
            'profilePicture' => 'https://example.com/avatar.jpg',
        ],
        'assignees' => [
            [
                'id' => 789,
                'username' => 'assignee1',
                'color' => '#0000ff',
                'initials' => 'A1',
                'email' => 'assignee1@example.com',
                'profilePicture' => 'https://example.com/assignee1.jpg',
            ],
        ],
        'watchers' => [
            [
                'id' => 101,
                'username' => 'watcher1',
                'color' => '#ff00ff',
                'initials' => 'W1',
                'email' => 'watcher1@example.com',
                'profilePicture' => 'https://example.com/watcher1.jpg',
            ],
        ],
        'priority' => [
            'id' => 'p1',
            'priority' => 'high',
            'color' => '#ff0000',
            'orderindex' => 1,
        ],
        'list' => [
            'id' => 'list_1',
            'name' => 'Test List',
            'access' => true,
        ],
        'project' => [
            'id' => 'proj_1',
            'name' => 'Test Project',
            'hidden' => false,
            'access' => true,
        ],
        'folder' => [
            'id' => 'folder_1',
            'name' => 'Test Folder',
            'hidden' => false,
            'access' => true,
        ],
        'space' => [
            'id' => 'space_1',
        ],
        'subtasks' => [
            [
                'id' => 'subtask_1',
                'name' => 'Test Subtask',
                'status' => [
                    'status' => 'open',
                    'color' => '#cccccc',
                ],
            ],
        ],
    ];

    $resource = new TaskResource($taskData);
    $formattedData = $resource->toArray();

    // Test main task data
    expect($formattedData)
        ->toBeArray()
        ->toHaveKey('id', '123')
        ->toHaveKey('custom_id', 'TASK-123')
        ->toHaveKey('name', 'Test Task');

    // Test status formatting
    expect($formattedData['status'])
        ->toBeArray()
        ->toHaveKey('id', 'status_1')
        ->toHaveKey('status', 'in_progress')
        ->toHaveKey('color', '#ff0000');

    // Test creator formatting
    expect($formattedData['creator'])
        ->toBeArray()
        ->toHaveKey('id', 456)
        ->toHaveKey('username', 'testuser')
        ->toHaveKey('email', 'test@example.com');

    // Test assignees formatting
    expect($formattedData['assignees'])
        ->toBeArray()
        ->toHaveCount(1)
        ->sequence(
            fn ($assignee) => $assignee
                ->toHaveKey('id', 789)
                ->toHaveKey('username', 'assignee1')
                ->toHaveKey('email', 'assignee1@example.com')
        );

    // Test priority formatting
    expect($formattedData['priority'])
        ->toBeArray()
        ->toHaveKey('id', 'p1')
        ->toHaveKey('priority', 'high')
        ->toHaveKey('color', '#ff0000');

    // Test subtasks formatting
    expect($formattedData['subtasks'])
        ->toBeArray()
        ->toHaveCount(1)
        ->sequence(
            fn ($subtask) => $subtask
                ->toHaveKey('id', 'subtask_1')
                ->toHaveKey('name', 'Test Subtask')
        );
});

it('handles missing optional fields gracefully', function () {
    $taskData = [
        'id' => '123',
        'name' => 'Test Task',
    ];

    $resource = new TaskResource($taskData);
    $formattedData = $resource->toArray();

    expect($formattedData)
        ->toBeArray()
        ->toHaveKey('id', '123')
        ->toHaveKey('name', 'Test Task')
        ->toHaveKey('custom_id', null)
        ->toHaveKey('text_content', '')
        ->toHaveKey('description', '')
        ->toHaveKey('priority', null)
        ->toHaveKey('assignees', [])
        ->toHaveKey('watchers', [])
        ->toHaveKey('subtasks', []);

    // Test status with missing data
    expect($formattedData['status'])
        ->toBeArray()
        ->toHaveKey('id', '')
        ->toHaveKey('status', '')
        ->toHaveKey('color', '')
        ->toHaveKey('type', '');
});

it('correctly formats a collection of tasks', function () {
    $tasksData = [
        [
            'id' => '123',
            'name' => 'Task 1',
            'status' => ['status' => 'open'],
        ],
        [
            'id' => '456',
            'name' => 'Task 2',
            'status' => ['status' => 'closed'],
        ],
    ];

    $formattedTasks = TaskResource::collection($tasksData);

    expect($formattedTasks)
        ->toBeArray()
        ->toHaveCount(2)
        ->sequence(
            fn ($task) => $task->toHaveKey('id', '123')->toHaveKey('name', 'Task 1'),
            fn ($task) => $task->toHaveKey('id', '456')->toHaveKey('name', 'Task 2')
        );
});
