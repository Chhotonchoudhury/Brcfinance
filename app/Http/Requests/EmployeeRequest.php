<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        $employeeId = $this->route('id'); // Get the agent ID from the route if available

        return [
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email' . ($employeeId ? ",$employeeId" : ''),
            'phone' => 'required|string|max:15|unique:employees,phone' . ($employeeId ? ",$employeeId" : ''),
            'gender' => 'required|in:Male,Female,Other',
            'joining_date' => 'required|date',
            'date_of_birth' => 'required|date',
            'is_active' => 'required|boolean',
            'aadhaar_number' => 'required|string|max:12|unique:employees,aadhaar_number' . ($employeeId ? ",$employeeId" : ''),
            'pan_number' => 'required|string|max:10|unique:employees,pan_number' . ($employeeId ? ",$employeeId" : ''),
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'signature' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'commission_rate' => 'nullable|numeric|min:0|max:100',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'document.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'document_type.*' => 'nullable|string|max:255',

             // Bank Details validation
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:20|unique:employees,account_number' . ($employeeId ? ",$employeeId" : ''),
            'ifsc_code' => 'required|string|max:11',
            'branch_name' => 'required|string|max:255',
            // Password fields
            'password' => $employeeId ? 'nullable|string|min:6|confirmed' : 'required|string|min:6|confirmed',
            'password_confirmation' => $employeeId ? 'nullable:password|string|min:6' : 'required_with:password|string|min:6',
            
            // ✅ Job Details
            'job_title' => 'required|string|max:255',
            'job_position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'employment_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',

            // ✅ Salary Details
            'base_salary' => 'nullable|numeric|min:0',
            'pf_amount' => 'nullable|numeric|min:0',
            'esi_amount' => 'nullable|numeric|min:0',
            'tds_amount' => 'nullable|numeric|min:0',
            'medical_allowance' => 'nullable|numeric|min:0',
            'travel_allowance' => 'nullable|numeric|min:0',
            'other_allowances' => 'nullable|numeric|min:0',
            'gross_salary' => 'nullable|numeric|min:0',
            'salary' => 'nullable|numeric|min:0',
            
             'login_days' => 'required|array|min:1',
            'login_days.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
    
            'login_start_time' => 'required',
            'login_end_time' => 'required|after:login_start_time',
    
            'roles' => 'required|exists:roles,id',
    
            'bank_cheque_1' => 'nullable|string|max:255',
            'bank_cheque_2' => 'nullable|string|max:255',
            'bank_cheque_3' => 'nullable|string|max:255',
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
            
              'login_days.required' => 'Please select at least one login day.',
            'login_start_time.required' => 'Login start time is required.',
            'login_end_time.after' => 'Login end time must be after start time.',
            'roles.required' => 'Please assign a role to the employee.',
            'roles.exists' => 'Selected role is invalid.',
        ];
    }
}
