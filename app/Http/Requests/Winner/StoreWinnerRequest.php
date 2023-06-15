<?php

namespace App\Http\Requests\Winner;

use Illuminate\Foundation\Http\FormRequest;

class StoreWinnerRequest extends FormRequest
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
            'winners' => 'required|array',
            'winners.*' => 'exists:auditors,id',
            'reward_id' => 'required|exists:rewards,id',
        ];
    }
}
