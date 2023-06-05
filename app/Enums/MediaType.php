<?php

namespace App\Enums;

enum MediaType: string
{
    case AUDIO = 'audio';
    case VIDEO = 'video';
    case PICTURE = 'picture';

    public static function getValues(): array
    {
        return array_column(MediaType::cases(), 'value');
    }
}
