<?php

namespace App\Rules;

use App\Models\Interaction;
use Illuminate\Contracts\Validation\Rule;

class NoActiveInteractions implements Rule
{
    public function passes($attribute, $value)
    {
        // 1. Obtenez les interactions actuelles
        $currentInteractions = Interaction::where('ended_at', '>', now())->orWhereNull('ended_at')->get();

        // 2. Vérifiez si d'autres interactions sont en cours
        $noCurrentInteractions = $currentInteractions->isEmpty();

        return $noCurrentInteractions;
    }

    public function message()
    {
        return 'Une autre interaction est en cours.';
    }
}
