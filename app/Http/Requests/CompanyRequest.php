<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'company_name' => ['required'],
            'company_department'=> ['required'],
            'company_address'=> ['required'],
            'company_postcode'=> ['required'],
            'company_city'=> ['required'],
            'company_country'=> ['nullable'],
            'company_manager_civility'=> ['required'],
            'company_manager_firstname'=> ['required'],
            'company_manager_lastname'=> ['required'],
            'company_manager_tel_number'=> ['required'],
            'company_manager_email'=> ['required', 'email'],
        ];
    }
}
