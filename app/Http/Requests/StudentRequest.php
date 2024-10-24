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
            'date_birth' => ['required', 'date'],
            'student_number' => ['required'],
            'telephone_number' => ['required'],
            'unistra_email' => ['required', 'email'],
            'address' => ['required'],
            'postcode' => ['required'],
            'city' => ['required'],
            'personal_email' => ['required', 'email'],
            'permanent_telephone_number' => ['nullable'],
            'permanent_address' => ['nullable'],
            'permanent_postcode' => ['nullable'],
            'permanent_city' => ['nullable'],
            'year_training_id' => 'required|exists:year_trainings,id',
            'actual_year_id' => 'required|exists:actual_years,id',
            'group_td_id' => 'required|exists:td_groups,id',
            'group_tp_id' => 'required|exists:tp_groups,id',
            'statuts_id' => 'required|exists:statuts,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'tutor_id' => 'nullable|exists:tutors,id',
            'training_courses_id' => 'nullable|exists:training_courses,id',
            'start_date_status' => 'nullable|date',
            'end_date_status' => 'nullable|date',
            'start_date_company' => 'nullable|date',
            'end_date_company' => 'nullable|date',
            'company_id' => 'nullable|exists:companies,id',
            'note' => 'nullable|string',
            'visit_statu' => 'nullable|string',
            'start_date_visit' => 'nullable|date',
            'end_date_visit' => 'nullable|date',
        ];
    }
}
