<?php

declare(strict_types=1);

namespace IbonAzkoitia\Clickup;

use IbonAzkoitia\Clickup\Contracts\SpaceInterface;
use IbonAzkoitia\Clickup\Http\Client;
use IbonAzkoitia\Clickup\Services\Spaces;

class Clickup
{
    private readonly Client $client;

    private ?SpaceInterface $spaces = null;

    public function __construct(
        string $apiToken,
        string $baseUrl
    ) {
        $this->client = new Client($apiToken, $baseUrl);
    }

    public function spaces(): SpaceInterface
    {
        if (! $this->spaces instanceof SpaceInterface) {
            $this->spaces = new Spaces($this->client);
        }

        return $this->spaces;
    }
}
