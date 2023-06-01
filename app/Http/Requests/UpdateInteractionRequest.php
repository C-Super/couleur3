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
        $type = $this->input('type');
        $typeableType = null;

        switch ($type) {
            case InteractionType::MCQ:
            case InteractionType::SURVEY:
                $typeableType = 'question_choices';
                break;
            case InteractionType::TEXT:
                $typeableType = null;
                break;
            case InteractionType::AUDIO:
            case InteractionType::VIDEO:
            case InteractionType::PICTURE:
                $typeableType = null;
                break;
            case InteractionType::CTA:
            case InteractionType::QUICK_CLICK:
                $typeableType = 'call_to_actions';
                break;
            default:
                // Handle unexpected interaction type
                break;
        }

        $rules = [
            'title' => 'required|max:255',
            'type' => 'required|in:'.implode(',', InteractionType::getValues()),
            'animator_id' => 'required|exists:animators,id',
            'reward_id' => 'exists:rewards,id',
            'winners_count' => 'nullable|integer',
        ];
        if ($typeableType !== null) {
            $rules['typeable_id'] = ['required', "exists:$typeableType,id"];
            $rules['typeable_type'] = 'required';
        }

        return $rules;
    }
}
