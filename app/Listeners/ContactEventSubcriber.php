<?php

namespace App\Listeners;

use App\Events\ContactRequestEvent;
use App\Mail\BookingProperty;
use Illuminate\Events\Dispatcher;
use Illuminate\Mail\Mailer;

class ContactEventSubcriber
{

    public function __construct(private Mailer $mailer){}

    public function mailContact(ContactRequestEvent $event)
    {
        $this->mailer->send(new BookingProperty($event->property, $event->data));
    }

    public function subscribe(Dispatcher $dispatcher): array
    {
        return [
            ContactRequestEvent::class => 'mailContact'
        ];
    }

}
