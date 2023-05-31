<?php

namespace App\Http\Requests;

use App\Enums\InteractionType;
use Illuminate\Foundation\Http\FormRequest;

class StoreInteractionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Logic for determining if the user can store an interaction goes here.
        // Return true if they can, false if they can't. For example:
        // return Auth::user()->can('create', Interaction::class);
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
            'title' => 'required|max:255',
            'type' => 'required|in:' . implode(',', InteractionType::getValues()),
            'typeable_id' => 'required',
            'typeable_type' => 'required',
            'animator_id' => 'required|exists:animators,id',
            'reward_id' => 'exists:rewards,id',
            'winners_count' => 'nullable|integer'
        ];
    }
}
