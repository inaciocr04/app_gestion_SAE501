<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'firstname' => ['required'],
            'lastname' => ['required'],
            'date_birth' => ['required'],
            'student_number' => ['required'],
            'telephone_number' => ['required'],
            'unistra_email' => ['required'],
            'address' => ['required'],
            'postcode' => ['required'],
            'city' => ['required'],
            'personal_email' => ['required'],
            'permanent_telephone_number' => ['required'],
            'permanent_address' => ['required'],
            'permanent_postcode' => ['required'],
            'permanent_city' => ['required'],
        ];
    }
}
