<x-mail::message>
# Demande de contact
Vous avez une demande pour <a href="{{ route('property.show', ['slug' => $property->slug(), 'property' => $property]) }}"> {{ $property->title }}</a>
de la part de {{ $data['lastname'] }} {{ $data['name'] }}

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
