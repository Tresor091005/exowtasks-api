<?php

namespace App\Http\Requests\V1;

use App\Enums\TacheStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTacheRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $tache = $this->route('task');
        $authenticatedUser = auth()->user();

        // Vérifier si l'utilisateur est le créateur de la tâche
        if ($tache->created_by === $authenticatedUser->id) {
            return true;
        }

        // Vérifier si l'utilisateur est assigné à la tâche
        $isAssigned = $tache->assignedMembers()->where('member_id', $authenticatedUser->id)->exists();

        return $isAssigned;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'due_date' => ['sometimes', 'date', 'after_or_equal:today'],
            'status' => ['sometimes', 'string', Rule::in(array_column(TacheStatus::cases(), 'value'))],
            'created_by' => ['sometimes', 'integer', 'exists:membres,id'],
            'assigned_members' => ['sometimes', 'nullable', 'array'],
            'assigned_members.*' => ['integer', 'exists:membres,id'],
        ];
    }
}
