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
        Schema::create('loan_against_deposit_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_code')->unique(); // Unique code for the plan
            $table->string('plan_name'); // Name of the plan
            $table->enum('deposit_type', ['FD', 'RD', 'MIS']); // Fixed, Recurring, or Monthly Income Scheme
            $table->decimal('interest_rate', 5, 2); // Loan interest rate
            $table->integer('tenure_months'); // Loan tenure in months
            $table->decimal('ltv_ratio', 5, 2)->default(75); // Loan-to-Value ratio (percentage)
            $table->decimal('min_loan_amount', 15, 2); // Minimum amount required
            $table->decimal('max_loan_amount', 15, 2)->nullable(); // Maximum loan amount
            $table->decimal('processing_fee', 10, 2)->default(0); // Processing fee
            
            $table->decimal('prepayment_charges', 5, 2)->default(0); // Prepayment penalty
            $table->integer('prepayment_lockin_period_months')->default(4); // Lock-in period in months
            
            $table->decimal('late_payment_daily_fine_rate', 5, 3)->default(0.1); // Daily fine in percent
            $table->integer('late_payment_fine_start_after_days')->default(0); // Days after due date before fine applies
            
            $table->decimal('stamp_duty_rate', 5, 2)->default(0); // E.g. 0.50 => 0.5%
            $table->decimal('insurance_rate', 5, 2)->default(0); // E.g. 1.00 => 1%
            
            // $table->decimal('late_payment_penalty', 10, 2)->default(0); // Late payment penalty
            $table->enum('emi_type', ['daily','monthly', 'quarterly', 'annually'])->default('monthly'); // EMI type
            $table->integer('grace_period_days')->default(0); // Grace period before EMI starts
            $table->boolean('status')->default(true); // Active or inactive
            $table->text('remarks')->nullable(); // Additional details
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_against_deposit_plans');
    }
};
