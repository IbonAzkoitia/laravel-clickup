<?php

declare(strict_types=1);

use IbonAzkoitia\LaravelClickup\ClickUp;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->clickup = app(ClickUp::class);
});

it('can list spaces from a team', function () {
    $teamId = env('CLICKUP_TEST_TEAM_ID');

    // Arrange
    Http::fake(function ($request) use ($teamId) {
        if ($request->url() === "https://api.clickup.com/api/v2/team/{$teamId}/space"
            && $request->header('Authorization')[0] === config('clickup.api_token')
            && $request->header('Content-Type')[0] === 'application/json'
        ) {
            return Http::response([
                'spaces' => [
                    ['id' => '1', 'name' => 'Space 1'],
                    ['id' => '2', 'name' => 'Space 2'],
                ],
            ]);
        }
    });

    // Act
    $response = $this->clickup->spaces()->list($teamId);

    // Assert
    Http::assertSent(function ($request) use ($teamId) {
        return $request->url() === "https://api.clickup.com/api/v2/team/{$teamId}/space";
    });

    expect($response)
        ->toBeArray()
        ->toHaveKey('spaces');

});
