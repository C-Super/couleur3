<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public bool $chat_enabled;

    public static function group(): string
    {
        return 'general';
    }
}
