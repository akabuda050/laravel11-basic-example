<?php

declare(strict_types=1);

namespace App\Services\Notifications;

interface Notification
{
    public function notify(string $to): void;
}
