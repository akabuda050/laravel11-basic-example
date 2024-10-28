<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SendNotificationRequest;
use App\Services\Notifications\Notification;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function send(SendNotificationRequest $request, Notification $notificationService): JsonResponse
    {
        $notificationService->notify($request->input('to'));

        return new JsonResponse([
            'sent_to' => $request->input('to'),
        ], 200);
    }
}
