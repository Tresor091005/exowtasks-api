<?php

namespace App\Http\Requests\V1;

use App\Enums\MembreRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMembreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:membres,email', 'max:255'],
            'role' => ['required', 'string', Rule::in(array_column(MembreRole::cases(), 'value'))],
            'team_id' => ['required', 'numeric', 'exists:equipes,id'],
            'joined_at' => ['nullable', 'date'],
        ];
    }
}
