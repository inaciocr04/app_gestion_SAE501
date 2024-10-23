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
            'permanent_telephone_number' => ['nullable'],
            'permanent_address' => ['nullable'],
            'permanent_postcode' => ['nullable'],
            'permanent_city' => ['nullable'],
            'year_training_id' => 'required|exists:year_trainings,id',
            'actual_year_id' => 'required|exists:actual_years,id',
            'group_td_id' => 'required|exists:td_groups,id',
            'group_tp_id' => 'required|exists:tp_groups,id',
            'statut_id' => 'required|exists:statuts,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'tutor_id' => 'nullable|exists:tutors,id',
        ];
    }
}
