<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnswerRequest extends FormRequest
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
            'auditor_id' => 'exists:auditors,id',
            'interaction_id' => 'exists:interactions,id',
            'replyable_id' => 'sometimes',
            'replyable_type' => 'in:App\Models\AnswerText,App\Models\QuestionChoice,App\Models\Media',
        ];
    }
}
