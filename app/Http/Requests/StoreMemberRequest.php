<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
        $memberId = $this->route('member') ?? $this->route('id'); // Dynamically get member ID from route

        return [
            // Basic Personal Information
            'application_number' => 'required|string|max:255|unique:memebers,application_number,' . ($memberId ?: 'NULL') . ',id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'email' => 'nullable|email|max:255|unique:memebers,email,' . ($memberId ?: 'NULL') . ',id',
            'mobile_number' => 'nullable|string|max:15|unique:memebers,mobile_number,' . ($memberId ?: 'NULL') . ',id',
            'aadhaar_number' => 'nullable|string|max:12|unique:memebers,aadhaar_number,' . ($memberId ?: 'NULL') . ',id',
            'pan_number' => 'nullable|string|max:10|unique:memebers,pan_number,' . ($memberId ?: 'NULL') . ',id',
            'marital_status' => 'nullable|in:single,married,divorced,widowed',

            // Bank Details
            'bank_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:20|unique:memebers,account_number,' . ($memberId ?: 'NULL') . ',id',
            'ifsc_code' => 'nullable|string|max:11',
            'branch_name' => 'nullable|string|max:255',
            'account_type' => 'nullable|in:savings,current',

            // Address Information
            'correspondence_address_line1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|string|max:6',
            'country' => 'required|string|max:255',

            // Nominee Details
            'nominee_name' => 'nullable|string|max:255',
            'nominee_relation' => 'nullable|string|max:255',
            'nominee_mobile_number' => 'nullable|string|max:15',
            'nominee_aadhaar_number' => 'nullable|string|max:12',
            'nominee_pan_number' => 'nullable|string|max:10',
            'nominee_voter_id' => 'nullable|string|max:255',
            'nominee_address' => 'nullable|string|max:500',

            // Document Uploads
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'signature' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'driving_license' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pan_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'aadhar_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'document.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'document_type.*' => 'nullable|string|max:255',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'application_number.unique' => 'The application number has already been taken.',
            'email.unique' => 'The email address is already in use.',
            'mobile_number.unique' => 'The mobile number is already in use.',
            'aadhaar_number.unique' => 'The Aadhaar number is already in use.',
            'pan_number.unique' => 'The PAN number is already in use.',
            'account_number.unique' => 'The bank account number is already in use.',
            'correspondence_address_line1.required' => 'The correspondence address is required.',
            'city.required' => 'The city is required.',
            'state.required' => 'The state is required.',
            'pincode.required' => 'The pincode is required.',
            'country.required' => 'The country is required.',
            'photo.image' => 'The photo must be a valid image (jpg, jpeg, png).',
            'signature.image' => 'The signature must be a valid image (jpg, jpeg, png).',
        ];
    }
}
