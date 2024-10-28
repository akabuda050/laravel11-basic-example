<?php

namespace App\Providers;

use App\Services\Notifications\MailNotification;
use App\Services\Notifications\Notification;
use App\Services\Notifications\SmsNotification;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use RuntimeException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Notification::class, function(Container $app) {
            $notificationProvider = $app->config->get('services.notifications_provider');

            return match ($notificationProvider) {
                'mail' => new MailNotification([
                    'host' => '127.0.0.1',
                ]),
                'sms' => new SmsNotification([
                    'vendor' => 'Vodafone',
                ]),
                default => throw new RuntimeException('Not suported notifications provider.'),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
