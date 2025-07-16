<?php

namespace App\Http\Requests\V1;

use App\Enums\TacheStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTacheRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['required', 'date', 'after_or_equal:today'],
            'status' => ['required', 'string', Rule::in(array_column(TacheStatus::cases(), 'value'))],
            'created_by' => ['required', 'integer', 'exists:membres,id'],
            'assigned_members' => ['nullable', 'array'],
            'assigned_members.*' => ['integer', 'exists:membres,id'],
        ];
    }
}
