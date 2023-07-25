<?php

namespace App\Services\Discord;

use App\Notifications\ContactRequestNotification;
use Illuminate\Http\Client\Factory as Http;
use Illuminate\Notifications\Notification;

class DiscordWebhookChannel
{
    public function __construct(public Http $http)
    {
    }

    public function send(object $notifiable, ContactRequestNotification $notification): void
    {
        if (! $url = $notifiable->routeNotificationFor('discord')) {
            return;
        }

        $payload = $this->buildPayload(
            $notification->toDiscord($notifiable)
        );
        $this->http->post($url, $payload);
    }

    protected function buildPayload(DiscordMessage $message): array
    {
        return [
            'embeds' => [
                [
                    'author' => [
                        'name' => $message->name,
                    ],
                    'description' => $message->text,
                ]
            ],
        ];
    }
}
