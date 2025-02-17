<?php

declare(strict_types=1);

namespace IbonAzkoitia\LaravelClickup\Http;

use IbonAzkoitia\LaravelClickup\Exceptions\AuthenticationException;
use IbonAzkoitia\LaravelClickup\Exceptions\ClickUpException;
use IbonAzkoitia\LaravelClickup\Exceptions\RateLimitException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Client
{
    private readonly PendingRequest $http;

    public function __construct(
        private readonly string $apiToken,
        private readonly string $baseUrl,
    ) {
        $this->http = Http::baseUrl($this->baseUrl)
            ->withHeaders([
                'Authorization' => $this->apiToken,
                'Content-Type' => 'application/json',
            ])
            ->timeout(30);
    }

    public function get(string $endpoint, array $query = []): array
    {
        $response = $this->http->get($endpoint, $query);

        return $this->handleResponse($response);
    }

    public function post(string $endpoint, array $data = []): array
    {
        $response = $this->http->post($endpoint, $data);

        return $this->handleResponse($response);
    }

    private function handleResponse($response): array
    {
        if ($response->successful()) {
            return $response->json();
        }

        match ($response->status()) {
            401 => throw new AuthenticationException('Invalid authentication credentials'),
            429 => throw new RateLimitException('Rate limit exceeded'),
            default => throw new ClickUpException(
                $response->json('error') ?? $response->body(),
                $response->status()
            ),
        };
    }
}
