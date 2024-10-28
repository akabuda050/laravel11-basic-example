<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Services\Notifications\Notification;
use Mockery\MockInterface;
use Tests\TestCase;

class NotificationControllerTest extends TestCase
{

    /** @test */
    public function it_returns_404_without_api_key_header(): void
    {
        $this->postJson('/api/notifications/send', [
            'to' => 'john.doe@example.com'
        ])->assertStatus(404);
    }

    /** @test */
    public function it_validates_request(): void
    {
        // Configure application api key
        $this->app->config->set('auth.api_key', 'qwerty');

        $this->postJson('/api/notifications/send', [], [
            'X-Requested-With-Api-Key' => 'qwerty',
        ])->assertJsonValidationErrors([
            'to' => 'The to field is required.',
        ]);
    }

    /** @test */
    public function it_returns_succesfull_response(): void
    {
        // Configure application api key
        $this->app->config->set('auth.api_key', 'qwerty');

        // Mock our service to check if it's called from controller with expected arguments.
        $this->mock(Notification::class, function (MockInterface $mock) {
            $mock->shouldReceive('notify')
                ->with('john.doe@example.com');
        });

        $this->postJson(
            '/api/notifications/send',
            [
                'to' => 'john.doe@example.com',
            ],
            [
                'X-Requested-With-Api-Key' => 'qwerty',
            ]
        )->assertJson([
            'sent_to' => 'john.doe@example.com',
        ])->assertStatus(200);
    }
}
