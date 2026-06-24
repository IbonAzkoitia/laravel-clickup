<?php

declare(strict_types=1);

namespace IbonAzkoitia\Clickup\Http;

use IbonAzkoitia\Clickup\Exceptions\ClickupAuthenticationException;
use IbonAzkoitia\Clickup\Exceptions\ClickupException;
use IbonAzkoitia\Clickup\Exceptions\ClickupRateLimitException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
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

    public function put(string $endpoint, array $data = []): array
    {
        $response = $this->http->put($endpoint, $data);

        return $this->handleResponse($response);
    }

    public function delete(string $endpoint, array $query = []): bool
    {
        $response = $this->http->delete($endpoint, $query);

        if ($response->successful()) {
            return true;
        }

        match ($response->status()) {
            401 => throw new ClickupAuthenticationException('Invalid authentication credentials'),
            429 => throw new ClickupRateLimitException('Rate limit exceeded'),
            default => throw new ClickupException(
                $this->formatErrorMessage(
                    $response->json('error', $response->body()),
                    (string) ($response->status())
                ),
            ),
        };

    }

    public function patch(string $endpoint, array $data = []): array
    {
        $response = $this->http->patch($endpoint, $data);

        return $this->handleResponse($response);
    }

    private function handleResponse(Response $response)
    {
        if ($response->successful()) {
            return $response->json();
        }

        match ($response->status()) {
            401 => throw new ClickupAuthenticationException('Invalid authentication credentials'),
            429 => throw new ClickupRateLimitException('Rate limit exceeded'),
            default => throw new ClickupException(
                $this->formatErrorMessage(
                    $response->json('error', $response->body()),
                    (string) ($response->status())
                ),
            ),
        };
    }

    private function formatErrorMessage(mixed $jsonError, string $bodyFallback): string
    {
        if (is_string($jsonError)) {
            return $jsonError;
        }

        if (is_array($jsonError) && isset($jsonError['message']) && is_string($jsonError['message'])) {
            return $jsonError['message'];
        }

        return $bodyFallback;
    }
}
