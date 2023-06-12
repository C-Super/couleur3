<?php

namespace App\Enums;

enum InteractionType: string
{
    case MCQ = 'MCQ';
    case SURVEY = 'SURVEY';
    case TEXT = 'TEXT';
    case AUDIO = 'AUDIO';
    case VIDEO = 'VIDEO';
    case PICTURE = 'PICTURE';
    case CTA = 'CTA';
    case QUICK_CLICK = 'QUICK_CLICK';

    public static function getValues(): array
    {
        return array_column(InteractionType::cases(), 'value');
    }
}
