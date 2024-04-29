<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UserPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    protected $redirect = '/employees';

    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $rules = [
            'name' => 'required|string',
            'phone' => 'required|regex:/^\d{10}$/|unique:employees,phone',
            'email' => 'required|email|unique:employees,email',
            'dob' => 'required',
            'aadhar_no' => 'required|regex:/^\d{12}$/',
            'pan_no' => 'required|unique:employees,pan_no'
        ];

        // For update operation
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $employeeId = $this->route('employee')->id;

            $rules['phone'] = 'required|numeric|min:10|unique:employees,phone,' . $employeeId;
            $rules['email'] = [
                'required',
                'email',
                Rule::unique('employees', 'email')->ignore($employeeId),
            ];
            $rules['pan_no'] = 'required|unique:employees,pan_no,' . $employeeId;
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        session()->flash('message', 'There were some issues with your submission. Please check the form and try again.');
        parent::failedValidation($validator);
    }


}
