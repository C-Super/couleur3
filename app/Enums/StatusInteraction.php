<?php

namespace App\Enums;

enum StatusInteraction: string
{
    case PENDING = 'pending';
    case STOPPED = 'stopped';

    public static function getValues(): array
    {
        return array_column(InteractionType::cases(), 'value');
    }
}
