<?php

namespace App\Http\Requests;

use App\Enums\InteractionType;
use Carbon\Carbon;
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
        $type = $this->input('type');
        $typeableType = null;

        switch ($type) {
            case 'cta':
            case 'quick_click':
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
            'ended_at' => [
                'required',
                'date_format:Y-m-d H:i:s',
                'after:'.Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        if ($typeableType !== null) {
            $rules['call_to_action_id'] = ['required', "exists:$typeableType,id"];
        }

        return $rules;
    }
}
