<?php

namespace App\Http\Requests;

use App\Enums\InteractionType;
use App\Enums\MediaType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAnswerRequest extends FormRequest
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
        $rules = [
            'interaction_id' => [
                'required',
                'exists:interactions,id',
                Rule::exists('interactions', 'id')->where(function ($query) {
                    $query->where('type', $this->type);
                }),
            ],
        ];

        switch ($this->type) {
            case InteractionType::TEXT->value:
                $rules = array_merge($rules, $this->textRules());
                break;
            case InteractionType::AUDIO->value:
            case InteractionType::VIDEO->value:
            case InteractionType::PICTURE->value:
                $rules = array_merge($rules, $this->mediaRules());
                break;
            case InteractionType::MCQ->value:
            case InteractionType::SURVEY->value:
                $rules = array_merge($rules, $this->questionChoiceRules());
                break;
        }

        return $rules;
    }

    private function textRules(): array
    {
        return [
            'replyable_data.content' => 'required|string',
        ];
    }

    private function mediaRules(): array
    {
        return [
            'type' => 'required|in:'.implode(',', MediaType::getValues()).'|same:replyable_data.type',
            'replyable_data.file' => 'required|file',
            'replyable_data.type' => 'required|in:'.implode(',', MediaType::getValues()),
        ];
    }

    private function questionChoiceRules(): array
    {
        return [
            'replyable_data.id' => 'required|exists:question_choices,id',
        ];
    }
}
