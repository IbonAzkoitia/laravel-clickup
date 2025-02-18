<?php

declare(strict_types=1);

namespace IbonAzkoitia\LaravelClickup\Services;

use IbonAzkoitia\LaravelClickup\Contracts\SpaceInterface;
use IbonAzkoitia\LaravelClickup\Http\Client;
use IbonAzkoitia\LaravelClickup\Resources\SpaceResource;

class Spaces implements SpaceInterface
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function list(string $teamId, array $params = []): array
    {
        $response = $this->client->get("/team/{$teamId}/space", $params);

        return [
            'spaces' => SpaceResource::collection($response['spaces']),
        ];
    }
}
