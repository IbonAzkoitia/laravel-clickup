<?php

declare(strict_types=1);

use IbonAzkoitia\LaravelClickup\ClickUp;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->clickup = app(ClickUp::class);
});

it('can list tasks from a list', function () {
    $listId = env('CLICKUP_TEST_LIST_ID');

    // Arrange
    Http::fake(function ($request) use ($listId) {
        if ($request->url() === "https://api.clickup.com/api/v2/list/{$listId}/task"
            && $request->header('Authorization')[0] === config('clickup.api_token')
            && $request->header('Content-Type')[0] === 'application/json'
        ) {
            return Http::response([
                'tasks' => [
                    ['id' => '1', 'name' => 'Task 1'],
                    ['id' => '2', 'name' => 'Task 2'],
                ],
            ]);
        }
    });

    // Act
    $response = $this->clickup->tasks()->list($listId);

    // Assert
    Http::assertSent(function ($request) use ($listId) {
        return $request->url() === "https://api.clickup.com/api/v2/list/{$listId}/task"
            && $request->method() === 'GET'
            && $request->header('Authorization')[0] === config('clickup.api_token')
            && $request->header('Content-Type')[0] === 'application/json';
    });

    expect($response)
        ->toBeArray()
        ->toHaveKey('tasks');
});

it('can create a new task', function () {

    $listId = env('CLICKUP_TEST_LIST_ID');

    $taskData = [
        'name' => 'New Task',
        'description' => 'Task Description',
    ];

    Http::fake(function ($request) use ($taskData, $listId) {
        if ($request->url() === 'https://api.clickup.com/api/v2/list/'.$listId.'/task'
            && $request->method() === 'POST'
            && $request->data() === $taskData
        ) {
            return Http::response([
                'id' => 'task_1',
                ...$taskData,
            ]);
        }
    });

    $response = $this->clickup->tasks()->create($listId, $taskData);

    expect($response)
        ->toBeArray()
        ->toHaveKey('id')
        ->toHaveKey('name')
        ->and($response['name'])->toBe('New Task');
});

it('can get a specific task', function () {
    $taskId = env('CLICKUP_TEST_TASK_ID');

    Http::fake(function ($request) use ($taskId) {
        if ($request->url() === 'https://api.clickup.com/api/v2/task/'.$taskId
            && $request->method() === 'GET'
        ) {
            return Http::response([
                'id' => 'task_123',
                'name' => 'Test Task',
                'description' => 'Task Description',
            ]);
        }
    });

    $response = $this->clickup->tasks()->get($taskId);

    expect($response)
        ->toBeArray()
        ->toHaveKey('id')
        ->and($response['id'])->toBe($taskId);
});

it('can update a task', function () {
    $listId = env('CLICKUP_TEST_LIST_ID');

    $taskData = [
        'name' => 'New Task',
        'description' => 'Task Description',
    ];

    Http::fake(function ($request) use ($taskData, $listId) {
        if ($request->url() === 'https://api.clickup.com/api/v2/list/'.$listId.'/task'
            && $request->method() === 'POST'
            && $request->data() === $taskData
        ) {
            return Http::response([
                'id' => 'task_1',
                ...$taskData,
            ]);
        }
    });

    $newTask = $this->clickup->tasks()->create($listId, $taskData);

    $updateData = [
        'name' => 'Updated Task Name',
        'description' => 'Updated Description',
    ];

    Http::fake(function ($request) use ($updateData, $newTask) {
        if ($request->url() === 'https://api.clickup.com/api/v2/task/'.$newTask['id']
            && $request->method() === 'PUT'
            && $request->data() === $updateData
        ) {
            return Http::response([
                'id' => $newTask['id'],
                ...$updateData,
            ]);
        }
    });

    $response = $this->clickup->tasks()->update($newTask['id'], $updateData);

    expect($response)
        ->toBeArray()
        ->toHaveKey('name')
        ->and($response['name'])->toBe('Updated Task Name');
});

it('can delete a task', function () {

    $listId = env('CLICKUP_TEST_LIST_ID');

    $taskData = [
        'name' => 'New Task',
        'description' => 'Task Description',
    ];

    Http::fake(function ($request) use ($taskData, $listId) {
        if ($request->url() === 'https://api.clickup.com/api/v2/list/'.$listId.'/task'
            && $request->method() === 'POST'
            && $request->data() === $taskData
        ) {
            return Http::response([
                'id' => 'task_1',
                ...$taskData,
            ]);
        }
    });

    $newTask = $this->clickup->tasks()->create($listId, $taskData);

    Http::fake(function ($request) use ($newTask) {
        if ($request->url() === 'https://api.clickup.com/api/v2/task/'.$newTask['id']
            && $request->method() === 'DELETE'
        ) {
            return Http::response([], 200);
        }
    });

    $response = $this->clickup->tasks()->delete($newTask['id']);

    Http::assertSent(function ($request) use ($newTask) {
        return $request->url() === 'https://api.clickup.com/api/v2/task/'.$newTask['id']
            && $request->method() === 'DELETE';
    });

    expect($response)->toBeTrue();
});

it('can get filtered team tasks', function () {
    $teamId = env('CLICKUP_TEST_TEAM_ID');

    Http::fake(function ($request) use ($teamId) {
        if ($request->url() === 'https://api.clickup.com/api/v2/team/'.$teamId.'/task'
            && $request->method() === 'GET'
        ) {
            return Http::response([
                'tasks' => [
                    ['id' => '1', 'name' => 'Team Task 1'],
                    ['id' => '2', 'name' => 'Team Task 2'],
                ],
            ]);
        }
    });

    $response = $this->clickup->tasks()->getFilteredTeamTasks($teamId);

    expect($response)
        ->toBeArray()
        ->toHaveKey('tasks');
});

it('can get time in status for a task', function () {
    $taskId = env('CLICKUP_TEST_TASK_ID');

    Http::fake(function ($request) use ($taskId) {
        if ($request->url() === 'https://api.clickup.com/api/v2/task/'.$taskId.'/time_in_status'
            && $request->method() === 'GET'
            && $request->header('Authorization')[0] === config('clickup.api_token')
            && $request->header('Content-Type')[0] === 'application/json'
        ) {
            return Http::response([
                'current_status' => [
                    'status' => 'abierto',
                    'color' => '#87909e',
                    'total_time' => [
                        'by_minute' => 10,
                        'since' => '1739819203374',
                    ],
                ],
                'status_history' => [
                    [
                        'status' => 'abierto',
                        'color' => '#87909e',
                        'type' => 'open',
                        'total_time' => [
                            'by_minute' => 9,
                            'since' => '1739819203374',
                        ],
                        'orderindex' => 0,
                    ],
                ],
            ]);
        }
    });

    $response = $this->clickup->tasks()->getTimeInStatus($taskId);

    expect($response)
        ->toBeArray()
        ->toHaveKey('current_status')
        ->and($response['current_status'])
        ->toHaveKey('total_time')
        ->and($response['current_status']['total_time'])
        ->toHaveKey('by_minute');
});

it('can create task from template', function () {
    $listId = env('CLICKUP_TEST_LIST_ID');
    $templateId = env('CLICKUP_TEST_TEMPLATE_ID');

    Http::fake(function ($request) use ($listId, $templateId) {
        if ($request->url() === 'https://api.clickup.com/api/v2/list/'.$listId.'/taskTemplate/'.$templateId
            && $request->method() === 'POST'
            && $request->data() === ['name' => 'New Template Task']
        ) {
            return Http::response([
                'id' => 'task_123',
                'task' => [
                    'id' => 'task_123',
                    'name' => 'New Template Task',
                    'status' => [
                        'status' => 'abierto',
                        'color' => '#87909e',
                        'type' => 'open',
                    ],
                    'creator' => [
                        'id' => 123,
                        'username' => 'Test User',
                        'email' => 'test@example.com',
                    ],
                    'assignees' => [],
                    'watchers' => [],
                    'checklists' => [],
                    'tags' => [],
                    'subtasks' => [],
                ],
            ]);
        }
    });

    $response = $this->clickup->tasks()->createFromTemplate($listId, $templateId, 'New Template Task');

    expect($response)
        ->toBeArray()
        ->toHaveKey('id')
        ->toHaveKey('task')
        ->and($response['task'])
        ->toHaveKey('name')
        ->and($response['task']['name'])->toBe('New Template Task')
        ->and($response['task'])
        ->toHaveKey('status')
        ->toHaveKey('subtasks');
});
