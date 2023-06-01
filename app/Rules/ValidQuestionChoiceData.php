<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Rule;

class ValidQuestionChoiceData implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($value as $choice) {
            $validator = Validator::make($choice, [
                'value' => 'required|string',
                'is_correct_answer' => 'required|boolean',
            ]);
        }
        // Perform your CTA-specific validation


        return $validator->passes();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Les données de la question ne sont pas valides.';
    }
}
