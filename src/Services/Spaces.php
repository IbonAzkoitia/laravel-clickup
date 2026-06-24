<?php

declare(strict_types=1);

namespace IbonAzkoitia\Clickup\Services;

use IbonAzkoitia\Clickup\Contracts\SpaceInterface;
use IbonAzkoitia\Clickup\Http\Client;
use IbonAzkoitia\Clickup\Resources\SpaceResource;

class Spaces implements SpaceInterface
{
    private string $teamId;

    public function __construct(
        private readonly Client $client
    ) {
        $this->teamId = config('clickup.workspace_id');
    }

    public function list(?array $params = []): array
    {
        $response = $this->client->get("/team/$this->teamId/space", $params);

        return [
            'spaces' => SpaceResource::collection($response['spaces']),
        ];
    }
}
