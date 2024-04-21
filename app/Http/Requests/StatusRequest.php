<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            // Loan Update Rules
            'status' => 'string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'disbursed_at' => 'date',
            'total_payable' => 'required|numeric|min:0',
            'emi' => 'required|numeric|min:0',

            // EMI Creation Rules
            'loan_id' => 'required|integer|exists:loans,id',
            'emi_number' => 'integer',
            'emi_amount' => 'numeric|min:0',
            'remaining_emi_balance' => 'numeric|min:0',
            'remaining_emi' => 'integer|min:1',
            'billing_date' => 'date',
            'due_date' => 'date|after_or_equal:billing_date',
            'payment_status' => 'string|in:unpaid,paid',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // You can customize the response here
        $response = [
            'status' => 'error',
            'errors' => $validator->errors(),
        ];

        // You can throw an exception with a custom response
        throw new HttpResponseException(response()->json($response, 422));
    }
}
