<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class LoanPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    protected $redirect = '/loans';

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
            'employee_id' => 'required',
            'loan_amount' => 'required',
            'repayment_period' => 'required',
            'interest_rate' => 'required',
            'loan_type' => 'required',
            
        ];
    }
}
