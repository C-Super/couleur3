<?php

namespace App\Http\Requests;

use App\Enums\InteractionType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInteractionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Logic for determining if the user can update this interaction goes here.
        // Return true if they can, false if they can't. For example:
        // return Auth::user()->can('update', $this->route('interaction'));
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
            'title' => 'max:255',
            'type' => 'in:' . implode(',', InteractionType::getValues()),
            'typeable_id' => 'required',
            'typeable_type' => 'required',
            'animator_id' => 'exists:animators,id',
            'reward_id' => 'exists:rewards,id',
            'winners_count' => 'nullable|integer'
        ];
    }
}
