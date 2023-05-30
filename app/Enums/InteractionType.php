<?php

namespace App\Enums;

enum InteractionType: string
{
    case MCQ = 'mcq';
    case SURVEY = 'survey';
    case TEXT = 'text';
    case AUDIO = 'audio';
    case VIDEO = 'video';
    case PICTURE = 'picture';
    case CTA = 'cta';
    case QUICK_CLICK = 'quick_click';

    public static function getValues(): array
    {
        return array_column(InteractionType::cases(), 'value');
    }
}
