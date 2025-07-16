<?php

namespace App\Http\Requests\V1;

use App\Enums\MembreRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMembreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Vérifier que l'utilisateur connecté est bien le membre qu'il veut modifier
        $membreToUpdate = $this->route('member');
        $authenticatedUser = auth()->user();

        return $authenticatedUser && $authenticatedUser->id === $membreToUpdate->id;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $membreId = $this->route('member')->id;

        return [
            'first_name' => ['sometimes', 'string', 'max:255'],
            'last_name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'unique:membres,email,' . $membreId, 'max:255'],
            'role' => ['sometimes', 'string', Rule::in(array_column(MembreRole::cases(), 'value'))],
            'team_id' => ['sometimes', 'numeric', 'exists:equipes,id'],
            'joined_at' => ['sometimes', 'nullable', 'date'],
            'password' => 'nullable|string|min:8',
        ];
    }
}
