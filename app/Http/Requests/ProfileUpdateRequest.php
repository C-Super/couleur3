<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'address.street' => 'sometimes|required_with_all:address.zip_code,address.city,address.country|string|max:255',
            'address.zip_code' => 'sometimes|required_with_all:address.street,address.city,address.country|integer',
            'address.city' => 'sometimes|required_with_all:address.street,address.zip_code,address.country|string|max:255',
            'address.country' => 'sometimes|required_with_all:address.street,address.zip_code,address.city|string|max:255',
        ];
    }
}
