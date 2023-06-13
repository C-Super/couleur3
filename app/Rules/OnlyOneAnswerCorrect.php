<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OnlyOneAnswerCorrect implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $correctAnswers = collect($value)->filter(fn ($choice) => $choice['is_correct_answer']);

        if ($correctAnswers->count() !== 1) {
            $fail('Une seule réponse peut être correcte.');
        }
    }
}
