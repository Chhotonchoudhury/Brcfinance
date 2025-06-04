<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
        $branchId = $this->route('id'); // Get the ID from the route (for update)

        return [
            'branch_name' => 'required|string|max:255',
            'branch_code' => 'required|string|max:255|unique:branches,branch_code,' . $branchId,
            'opening_date' => 'required|date',
            'ifsc_code' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_no' => 'required|string|max:15',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'notes' => 'nullable|string|max:500',
            'payment_service' => 'required|in:0,1',
            'transfer_service' => 'required|in:0,1',
            'status' => 'required|in:0,1',
        ];
    }

     /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'branch_name.required' => 'Branch name is required.',
            'branch_code.required' => 'Branch code is required.',
            'branch_code.unique' => 'Branch code must be unique.',
            'city.required' => 'City is required.',
            'state.required' => 'State is required.',
            'pincode.required' => 'Pincode is required.',
            'country.required' => 'Country is required.',
            'payment_service.required' => 'Payment service status is required.',
            'transfer_service.required' => 'Transfer service status is required.',
            'status.required' => 'Status is required.',
        ];
    }
}
