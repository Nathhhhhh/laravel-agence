<?php

namespace App\Notifications;

use App\Models\Property;
use App\Services\Discord\DiscordMessage;
use App\Services\Discord\DiscordWebhookChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactRequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private Property $property, private array $data)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', DiscordWebhookChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDiscord(object $notifiable): DiscordMessage
    {
        return new DiscordMessage(
            name: $this->data['lastname'],
            text: htmlspecialchars_decode('Vous avez une demande pour le bien situé à l\'adresse suivante : ' . route('property.show', ['slug' => $this->property->slug(), 'property' => $this->property]) . ' de la part de '.$this->data['lastname']) . " " . $this->data['name']
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
