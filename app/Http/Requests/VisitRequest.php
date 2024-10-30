<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitRequest extends FormRequest
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
            'student_id' => 'required',
            'company_id' => 'nullable',
            'year_training_id' => 'required',
            'note' => 'nullable',
            'visit_statu' => 'NON',
            'start_date_visit' => 'nullable|dateTime',
            'end_date_visit' => 'nullable|dateTime',
        ];
    }
}
