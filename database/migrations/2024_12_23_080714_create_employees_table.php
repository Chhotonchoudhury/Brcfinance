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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code')->unique(); // Unique Employee Code (e.g., EM02486)
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 15)->unique();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('aadhaar_number', 12)->unique();
            $table->string('pan_number', 10)->unique();
            $table->string('photo')->nullable();
            $table->string('signature')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('branch_name')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode', 6)->nullable();
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->date('joining_date')->nullable();
            
            $table->string('job_title');
            $table->string('job_position');
            $table->string('department');
            $table->string('employment_type');
            $table->date('start_date');
            $table->date('end_date')->nullable(); // if the job/contract ends

            $table->decimal('base_salary', 10, 2)->nullable(); // fixed base
            $table->decimal('pf_amount', 10, 2)->nullable();   // Provident Fund
            $table->decimal('esi_amount', 10, 2)->nullable();  // Employee State Insurance
            $table->decimal('tds_amount', 10, 2)->nullable();  // Employee State Insurance
            $table->decimal('medical_allowance', 10, 2)->nullable();
            $table->decimal('travel_allowance', 10, 2)->nullable();
            $table->decimal('other_allowances', 10, 2)->nullable();
            $table->decimal('gross_salary', 10, 2)->nullable(); // base + pf + esi + allowances
            $table->decimal('salary', 10, 2)->nullable(); // Salary =  gross_salary - base_salary
            
            
            $table->decimal('commission_rate', 8, 2)->nullable(); // Commission Rate
            $table->boolean('is_active')->default(true);
            $table->json('documents')->nullable(); // JSON field for documents
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
