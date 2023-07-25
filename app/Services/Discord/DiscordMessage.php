<?php

namespace App\Services\Discord;

class DiscordMessage
{
    public function __construct(
        public string $name,
        public string $text,
    ) {
    }
}
