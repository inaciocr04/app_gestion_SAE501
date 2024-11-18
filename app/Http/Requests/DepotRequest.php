<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepotRequest extends FormRequest
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
            'name_depot' => 'required|string',
            'depot_link' => 'required|string',
            'actual_year_id' => 'required|exists:actual_years,id',
            'year_training_id' => 'required|exists:year_trainings,id',
            'end_date_depot' => 'nullable|date',
        ];
    }
}
