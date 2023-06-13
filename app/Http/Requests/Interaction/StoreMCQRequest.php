<?php

namespace App\Http\Requests\Interaction;

use App\Rules\OnlyOneAnswerCorrect;
use Illuminate\Foundation\Http\FormRequest;

class StoreMCQRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'duration' => 'required|integer|min:15|max:3600',
            'question_choices' => [
                'required',
                'array',
                'min:2',
                'max:4',
                new OnlyOneAnswerCorrect(),
            ],
            'question_choices.*.value' => 'required|string|min:1|max:255',
            'question_choices.*.is_correct_answer' => 'required|boolean',
        ];
    }
}
