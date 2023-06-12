<?php

namespace App\Rules;

use App\Models\Interaction;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoActiveInteractions implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 1. Obtenez les interactions actuelles
        $activeInteractions = Interaction::active()->orWhereNull('ended_at')->get();

        dd($currentInteractions);

        // 2. Vérifiez si d'autres interactions sont en cours
        if (! $currentInteractions->isEmpty()) {
            $fail('Une autre interaction est en cours.');
        }
    }
}
