<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MinTwoChoices implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $hasValues = collect($value)->filter(fn ($choice) => $choice['value'] !== null);

        if ($hasValues->count() < 2) {
            $fail('Vous devez avoir au moins 2 choix.');
        }
    }
}
