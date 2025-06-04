<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentRequest extends FormRequest
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
        $agentId = $this->route('id'); // Get the agent ID from the route if available

        return [
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:agents,email' . ($agentId ? ",$agentId" : ''),
            'phone' => 'required|string|max:15|unique:agents,phone' . ($agentId ? ",$agentId" : ''),
            'gender' => 'required|in:Male,Female,Other',
            'joining_date' => 'required|date',
            'date_of_birth' => 'required|date',
            'is_active' => 'required|boolean',
            'aadhaar_number' => 'required|string|max:12|unique:agents,aadhaar_number' . ($agentId ? ",$agentId" : ''),
            'pan_number' => 'required|string|max:10|unique:agents,pan_number' . ($agentId ? ",$agentId" : ''),
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'signature' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'document.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'document_type.*' => 'nullable|string|max:255',

             // Bank Details validation
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:20|unique:agents,account_number' . ($agentId ? ",$agentId" : ''),
            'ifsc_code' => 'required|string|max:11',
            'branch_name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'The email address is already in use.',
            'phone.unique' => 'The phone number is already in use.',
            'aadhaar_number.unique' => 'The Aadhaar number is already in use.',
            'pan_number.unique' => 'The PAN number is already in use.',

                  // Bank Details error messages
            'bank_name.required' => 'The bank name is required.',
            'account_number.required' => 'The account number is required.',
            'account_number.unique' => 'The account number is already in use.',
            'ifsc_code.required' => 'The IFSC code is required.',
            'branch_name.required' => 'The branch name is required.',
        ];
    }
}
