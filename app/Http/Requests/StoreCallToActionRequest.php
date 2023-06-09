<?php

namespace App\Http\Requests;

use App\Rules\NoActiveInteractions;
use Illuminate\Foundation\Http\FormRequest;

class StoreCallToActionRequest extends FormRequest
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
            'link' => 'required|url',
            'duration' => 'required|integer|min:15|max:3600',
            new NoActiveInteractions(),
        ];
    }
}
