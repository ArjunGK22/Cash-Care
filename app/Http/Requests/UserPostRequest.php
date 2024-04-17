<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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

    
        return [
            'name' => 'required|string',
            'phone' => 'required|numeric|min:10|unique:employees,phone',
            'email' => 'required|email|unique:employees,email',
            'dob' => 'required',
            'aadhar_no' => 'required|numeric|min:12|unique:employees,aadhar_no',
            'pan_no' => 'required|unique:employees,pan_no'
        ];
    }
}
