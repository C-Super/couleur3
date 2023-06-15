<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Password::defaults()],
            'address.street' => 'required_with_all:address.zip_code,address.city,address.country|string|max:255',
            'address.zip_code' => 'required_with_all:address.street,address.city,address.country|integer',
            'address.city' => 'required_with_all:address.street,address.zip_code,address.country|string|max:255',
            'address.country' => 'required_with_all:address.street,address.zip_code,address.city|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'address.street.required_with_all' => 'Le champ rue est requis lorsque le code postal, la ville ou le pays est présent.',
            'address.zip_code.required_with_all' => 'Le champ code postal est requis lorsque la rue, la ville ou le pays est présent.',
            'address.city.required_with_all' => 'Le champ ville est requis lorsque la rue, le code postal ou le pays est présent.',
            'address.country.required_with_all' => 'Le champ pays est requis lorsque la rue, le code postal ou la ville est présent.',
        ];
    }
}
