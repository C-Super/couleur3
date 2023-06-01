<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public bool $is_chat_enabled;

    public static function group(): string
    {
        return 'general';
    }
}
