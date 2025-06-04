<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Company;
class StoreCompanyRequest extends FormRequest
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
        $company = Company::first();
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'incorp_date' => 'required|date',
            'cin_label' => 'nullable|string|max:255',
            'pan' => 'required|string|max:255',
            'gst_no' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'class' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            // 'currency' => 'nullable|string|max:255',
            'authorized_capital' => 'required|numeric',
            'paid_up_capital' => 'required|numeric',
            'shares_nominal_value' => 'required|numeric',
            'about' => 'nullable|string|max:500',
            'address' => 'nullable|string|max:500',
            'company_logo' => [
                $company ? 'nullable' : 'required', // Required only if no company exists
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
            ],
            'favicon' => [
                $company ? 'nullable' : 'required', // Required only if no company exists
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:1024',
            ],
        ];
    }

        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Company name is required.',
            'email.email' => 'Please enter a valid email address.',
            'phone.max' => 'Phone number cannot exceed 20 characters.',
            'company_logo.image' => 'Company logo must be an image file.',
            'favicon.image' => 'Favicon must be an image file.',
        ];
    }

}
