<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\MediaType;

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
            'auditor_id' => 'required|exists:auditors,id',
            'interaction_id' => [
                'required',
                'exists:interactions,id',
                Rule::exists('interactions', 'id')->where(function ($query) {
                    $query->where('type', $this->type);
                }),
            ],
            'type' => 'required|in:text,picture,audio,video,mcq,survey',
            'replyable_data' => 'required|array',
        ];

        if ($this->type === 'text') {
            $rules['replyable_data.content'] = 'required|string';
        } elseif ($this->type === 'audio' || $this->type === 'video' || $this->type === 'picture') {
            $rules['type'] = 'required|in:text,picture,audio,video,mcq,survey|same:replyable_data.type';
            $rules['replyable_data.path'] = 'required|string';
            $rules['replyable_data.type'] = 'required|in:' . implode(',', MediaType::getValues());
        } elseif ($this->type === 'mcq' || $this->type === 'survey') {
            $rules['replyable_data.id'] = 'required|exists:question_choices,id';
        }

        return $rules;
    }
}
