<?php

namespace App\Http\Requests;

use App\Models\Answer;
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
            'interaction_id' => 'required|exists:interactions,id',
            'auditor_ids' => 'required|array',
            'auditor_ids.*' => 'exists:auditors,id',
            'reward_id' => 'required|exists:rewards,id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $interaction_id = $this->get('interaction_id');
            $auditor_ids = $this->get('auditor_ids');

            $answer_count = Answer::where('interaction_id', $interaction_id)->count();
            if (count($auditor_ids) > $answer_count) {
                $validator->errors()->add('auditor_ids', 'Il y a plus de gagnant que de réponses.');
            }

            $interaction_answers_auditors = Answer::where('interaction_id', $interaction_id)->pluck('auditor_id')->toArray();
            $invalid_auditors = array_diff($auditor_ids, $interaction_answers_auditors);
            if (! empty($invalid_auditors)) {
                $validator->errors()->add('auditor_ids', 'Certains auditeurs sélectionné ne sont pas dans la liste des participants.');
            }
        });
    }
}
