<?php

declare(strict_types=1);

namespace IbonAzkoitia\LaravelClickup;

use IbonAzkoitia\LaravelClickup\Contracts\SpaceInterface;
use IbonAzkoitia\LaravelClickup\Contracts\TasksInterface;
use IbonAzkoitia\LaravelClickup\Http\Client;
use IbonAzkoitia\LaravelClickup\Services\Spaces;
use IbonAzkoitia\LaravelClickup\Services\Tasks;

class ClickUp
{
    private readonly Client $client;

    private ?SpaceInterface $spaces = null;

    private ?TasksInterface $tasks = null;

    public function __construct(
        string $apiToken,
        string $baseUrl,
    ) {
        $this->client = new Client($apiToken, $baseUrl);
    }

    public function tasks(): TasksInterface
    {
        if (! $this->tasks instanceof \IbonAzkoitia\LaravelClickup\Contracts\TasksInterface) {
            $this->tasks = new Tasks($this->client);
        }

        return $this->tasks;
    }

    public function spaces(): SpaceInterface
    {
        if (! $this->spaces instanceof \IbonAzkoitia\LaravelClickup\Contracts\SpaceInterface) {
            $this->spaces = new Spaces($this->client);
        }

        return $this->spaces;
    }
}
