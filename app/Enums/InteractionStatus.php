<?php

namespace App\Enums;

enum InteractionStatus: string
{
    case PENDING = 'PENDING';
    case STOPPED = 'STOPPED';

    public static function getValues(): array
    {
        return array_column(InteractionStatus::cases(), 'value');
    }
}
