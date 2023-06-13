<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxFourChoices implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $hasValues = collect($value)->filter(fn ($choice) => $choice['value'] !== "");

        if ($hasValues->count() > 4) {
            $fail('Vous ne pouvez pas avoir plus de 4 choix.');
        }
    }
}
