<?php

namespace Tests\Feature\Services\Notifications;

use App\Services\Notifications\MailNotification;
use App\Services\Notifications\Notification;
use App\Services\Notifications\SmsNotification;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    public static function providesNotificationServices()
    {
        return [
            ['sms', SmsNotification::class],
            ['mail', MailNotification::class],
        ];
    }

    /**
     * Run same test for set of data provided by "providesNotificationServices" method above.
     *
     * @dataProvider providesNotificationServices
     */
    public function test_app_builds_service_based_on_config(string $provider, string $expectedProivider): void
    {

        $this->app->config->set('services.notifications_provider', $provider);

        $this->assertInstanceOf($expectedProivider, $this->app->make(Notification::class));
    }
}
