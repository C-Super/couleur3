<?php

namespace App\Enums;

enum MediaType: string
{
    case AUDIO = 'AUDIO';
    case VIDEO = 'VIDEO';
    case PICTURE = 'PICTURE';

    public static function getValues(): array
    {
        return array_column(MediaType::cases(), 'value');
    }
}
