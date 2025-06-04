<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('memebers', function (Blueprint $table) {
            $table->id();
                
            // Basic Personal Information
            $table->string('member_code')->unique();  // Unique member code
            $table->string('application_number')->unique();  // Application number
            $table->string('title')->nullable();  // Title (e.g., Mr, Mrs)
            $table->string('first_name');  // First name
            $table->string('middle_name')->nullable();  // Middle name (optional)
            $table->string('last_name');  // Last name
            $table->date('date_of_birth');  // Date of birth
            $table->string('occupation')->nullable();  // Occupation
            $table->decimal('annual_income', 15, 2)->nullable();  // Annual income
            $table->decimal('monthly_income', 15, 2)->nullable();  // Monthly income
            $table->string('father_name')->nullable();  // Father's name
            $table->string('mother_name')->nullable();  // Mother's name
            $table->string('husband_spouse')->nullable();  // Husband/Spouse name
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();  // Marital status
            $table->date('enrollment_date');  // Enrollment date
            $table->boolean('ex_service_person')->default(false);  // Ex-service person flag
            $table->string('email')->unique();  // Email address
            $table->boolean('email_is_active')->default(true);  // Email active status
            $table->string('mobile_number');  // Mobile number
            $table->boolean('mobile_is_active')->default(true);  // Mobile active status
            $table->string('aadhaar_number')->nullable();  // Aadhaar number
            $table->string('voter_id')->nullable();  // Voter ID
            $table->string('pan_number')->nullable();  // PAN number
            $table->string('ration_card_number')->nullable();  // Ration card number
            $table->string('meter_number')->nullable();  // Meter number
            $table->string('ci_number')->nullable();  // CI number
            $table->string('ci_relation')->nullable();  // CI relation
            $table->string('dl_number')->nullable();  // Driving license number

            //bank details
            $table->string('bank_name')->nullable();  // Bank name
            $table->string('bank_code')->nullable();  // Bank code
            $table->enum('account_type', ['savings', 'current'])->nullable();  // Account type
            $table->string('account_number')->nullable();  // Bank account number
            $table->string('ifsc_code')->nullable();  // IFSC code
            $table->string('branch_name')->nullable();  // Branch name
            
            // Correspondence Address
            $table->string('correspondence_address_line1');  // Address line 1
            $table->string('correspondence_address_line2')->nullable();  // Address line 2
            $table->string('para')->nullable();  // Para
            $table->string('panchayat')->nullable();  // Panchayat
            $table->string('ward')->nullable();  // Ward
            $table->string('area')->nullable();  // Area
            $table->string('landmark')->nullable();  // Landmark
            $table->string('city');  // City
            $table->string('state');  // State
            $table->string('pincode');  // Pincode
            $table->string('country');  // Country

            // Permanent Address
            $table->string('permanent_address')->nullable();  // Permanent address line 1
            $table->string('permanent_city')->nullable();  // Permanent city
            $table->string('permanent_state')->nullable();  // Permanent state
            $table->string('permanent_pincode')->nullable();  // Permanent pincode
            $table->boolean('use_as_communication_address')->default(false);  // Use as communication address

            // Address Geolocation
            $table->decimal('address_latitude', 10, 7)->nullable();  // Latitude for address
            $table->decimal('address_longitude', 10, 7)->nullable();  // Longitude for address

            // Nominee Details
            $table->string('nominee_name')->nullable();  // Nominee name
            $table->string('nominee_relation')->nullable();  // Nominee relation
            $table->string('nominee_mobile_number')->nullable();  // Nominee mobile number
            $table->string('nominee_aadhaar_number')->nullable();  // Nominee Aadhaar number
            $table->string('nominee_voter_id')->nullable();  // Nominee Voter ID
            $table->string('nominee_pan_number')->nullable();  // Nominee PAN number
            $table->string('nominee_ration_card_number')->nullable();  // Nominee ration card number
            $table->string('nominee_address')->nullable();  // Nominee address

            // Alerts and Notifications
            $table->boolean('enable_sms_alert')->default(true);  // SMS alert flag

             // Document Uploads
             $table->string('photo')->nullable();  // Photo (file path)
             $table->string('signature')->nullable();  // Signature (file path)
             $table->string('driving_license')->nullable();  // Driving license (file path)
             $table->string('pan_card')->nullable();  // PAN card (file path)
             $table->string('aadhar_card')->nullable();  // Aadhaar card (file path)
 
             // Multiple Documents JSON
             $table->json('documents')->nullable();  // JSON column for storing multiple document details

                     // Approval and Status Fields
            // $table->enum('employee_approval', ['pending', 'approved', 'rejected'])->default('pending');  // Employee approval status
            // $table->enum('admin_approval', ['pending', 'approved', 'rejected'])->default('pending');  // Admin approval status
            $table->enum('status', ['active', 'inactive'])->default('active');  // Member status (active/inactive)

            $table->enum('member_type', ['Normal', 'Agent', 'Employee', 'Promoter', 'Director'])->default('Normal');  // Member type (default to normal)
            $table->foreignId('person_id')->nullable()->constrained('users')->onDelete('set null');  // Nullable role_id referencing users table

            // Foreign Keys
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');  // Foreign key for branch
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Foreign key for the user (if using a unified user table)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memebers');
    }
};
