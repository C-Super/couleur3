<?php

namespace App\Enums;

enum InteractionStatus: string
{
    case PENDING = 'pending';
    case STOPPED = 'stopped';

    public static function getValues(): array
    {
        return array_column(InteractionStatus::cases(), 'value');
    }
}
