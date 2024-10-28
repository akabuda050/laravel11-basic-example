<?php

declare(strict_types=1);

namespace App\Services\Notifications;

final class MailNotification implements Notification
{

    public function __construct(private array $credentials)
    {
    }

    public function notify(string $to): void
    {
        //
    }
}
