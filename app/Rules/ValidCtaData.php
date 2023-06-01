<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ValidCtaData implements Rule
{
    private $errorMessage = '';

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $validator = null;

        // Perform your CTA-specific validation
        foreach ($value as $choice) {
            $validator = Validator::make($choice, [
                'description' => 'required|string',
                'link' => 'nullable|url',
                'button_text' => 'required|string',
            ]);
        }

        if ($validator->fails()) {
            $this->errorMessage = $validator->errors()->first();

            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errorMessage;
    }
}
