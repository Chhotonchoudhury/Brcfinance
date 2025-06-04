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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();

            // Unique Agent ID
            $table->string('agent_code')->unique(); // Example: AG02486
            // Personal Information
            $table->string('name'); // Full Name
            $table->string('email')->unique(); // Email Address
            $table->string('phone', 15)->unique(); // Phone Number
            $table->string('gender')->nullable(); // Gender (Male/Female/Other)
            $table->date('date_of_birth')->nullable(); // Date of Birth

            // Identification Documents
            $table->string('aadhaar_number', 12)->unique(); // Aadhaar Number
            $table->string('pan_number', 10)->unique(); // PAN Number
            $table->string('photo')->nullable(); // Path to Photo
            $table->string('signature')->nullable(); // Path to Signature

            // Bank Details
            $table->string('bank_name')->nullable(); // Bank Name
            $table->string('account_number')->nullable(); // Account Number
            $table->string('ifsc_code')->nullable(); // IFSC Code
            $table->string('branch_name')->nullable(); // Bank Branch Name

            // Address Information
            $table->text('address')->nullable(); // Permanent Address
            $table->string('city')->nullable(); // City
            $table->string('state')->nullable(); // State
            $table->string('pincode', 6)->nullable(); // PIN/ZIP Code

            // Employment Information
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade'); // Reference to Branch
            $table->date('joining_date')->nullable(); // Joining Date
            $table->decimal('commission_rate', 8, 2)->nullable(); // Commission Rate (e.g., percentage)

            // Additional Details
            $table->boolean('is_active')->default(true); // Active Status
            $table->json('documents')->nullable(); // JSON field to store additional uploaded documents
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
