<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutorRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'civility' => 'required|string',
            'lastname' => 'required|string',
            'firstname' => 'required|string',
            'telephone_number' => 'required|string|max:15',
            'email' => 'required|email',
            'company_id' => 'nullable|exists:companies,id',
        ];
    }
}
