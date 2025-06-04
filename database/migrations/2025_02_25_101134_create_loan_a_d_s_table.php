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
        Schema::create('loan_a_d_s', function (Blueprint $table) {
            $table->id();
            $table->string('application_number')->unique(); // Unique loan account number
            $table->string('account_number')->unique(); // Unique loan account number
            // Foreign Keys
            $table->unsignedBigInteger('member_id'); // Linked to members table
            $table->unsignedBigInteger('branch_id'); // Linked to branches table
            $table->unsignedBigInteger('associate_id')->nullable(); // Linked to agents table
            $table->unsignedBigInteger('plan_id'); // Linked to loan plans table

            // Loan Against Deposit Details
            $table->enum('against_type', ['FD', 'RD', 'MIS']); // Loan taken against FD, RD, or MIS
            $table->string('against_account_number')->nullable(); // FD/RD/MIS account number reference
            $table->decimal('asset_value', 15, 2)->default(0); // Value of deposit account as collateral
            $table->decimal('asset_paid_value', 15, 2)->default(0); // Value of deposit account as collateral
            $table->decimal('ltv_ratio', 5, 2)->default(75); // Loan-to-Value ratio (percentage)

            // Loan Application & Approval
            $table->decimal('application_balance', 15, 2)->default(0); // Loan amount requested
            $table->decimal('approved_balance', 15, 2)->default(0); // Loan amount approved
            $table->enum('application_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedBigInteger('application_approved_by')->nullable(); // User ID who approved
            $table->timestamp('application_approved_at')->nullable();          // When approved

            $table->unsignedBigInteger('application_rejected_by')->nullable(); // User ID who approved
            $table->timestamp('application_rejected_at')->nullable(); 


            $table->timestamp('application_at')->nullable();  

            $table->decimal('interest_rate', 5, 2)->default(0); // Annual interest % for this loan
            $table->decimal('processing_fee', 10, 2)->default(0); // Processing fee
            $table->decimal('stamp_duty_rate', 5, 2)->default(0); // E.g. 0.50 => 0.5%
            $table->decimal('insurance_rate', 5, 2)->default(0); // E.g. 1.00 => 1%


            // Verification Process
            $table->enum('document_verification_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->unsignedBigInteger('document_verified_by')->nullable();
            $table->timestamp('document_verified_at')->nullable();
            $table->string('verification_document_type')->nullable();  // Path to the member verification document
            $table->string('verification_document_path')->nullable();  // Path to the member verification document

            $table->unsignedBigInteger('document_rejected_by')->nullable();
            $table->timestamp('document_rejected_at')->nullable();

            $table->json('verification_documents')->nullable();




               // Loan Disbursement
            $table->enum('disbursement_status', ['pending', 'disbursed'])->default('pending');
            $table->enum('disbursement_mode', ['cash','savings_account', 'bank_transfer', 'cheque'])->nullable();
            $table->string('disbursement_reference')->nullable(); 
            $table->string('disbursement_note')->nullable(); // for cheque no, savings acc no, txn id, etc.
            $table->decimal('disbursement_amount', 15, 2)->default(0); // Amount disbursed
            $table->date('loan_disbursement_date')->nullable();
            $table->unsignedBigInteger('disbursed_by')->nullable();
            $table->timestamp('disbursed_at')->nullable();

            
            
            // Loan Terms
            $table->enum('loan_status', ['active', 'closed', 'defaulted'])->default('active'); // Loan lifecycle status
            $table->date('loan_start_date')->nullable(); // Date loan starts
            $table->date('loan_end_date')->nullable(); // Expected end date
            $table->decimal('emi_amount', 15, 2)->default(0); // Fixed EMI per installment
            $table->integer('number_of_emis')->default(0);
            $table->enum('emi_type', ['daily','monthly', 'quarterly', 'annually'])->default('daily'); // EMI type
            $table->decimal('remaining_balance', 15, 2)->default(0); // Remaining loan balance
            $table->boolean('fully_paid')->default(false); // Whether the loan is fully paid
            $table->decimal('total_payable_amount', 15, 2)->default(0); // Total payable including interest
            $table->decimal('total_paid_amount', 15, 2)->default(0); // Total amount paid by the member
            $table->integer('tenure_months')->nullable(); // Loan tenure in months

             // Due & Fine Tracking
            $table->decimal('total_due', 15, 2)->default(0);
            $table->decimal('current_due', 15, 2)->default(0);
            $table->decimal('total_fine', 15, 2)->default(0);
            $table->decimal('current_fine', 15, 2)->default(0);
            $table->integer('missed_installments')->default(0);
            
            // Important Dates
            $table->enum('loan_approval_status', ['pending', 'approved', 'rejected'])->default('pending'); // Approval status
            $table->date('application_date')->nullable(); // Loan application submission date
            $table->unsignedBigInteger('approved_by')->nullable(); // User who approved the loan
            $table->timestamp('approved_at')->nullable(); // Timestamp when the loan was approved

            //forclosed
            $table->boolean('is_foreclosed')->default(false);
            $table->date('foreclosed_date')->nullable();
            $table->decimal('foreclosure_amount', 15, 2)->nullable(); // Final settlement amount if closed early

            $table->unsignedBigInteger('application_by')->nullable(); // User who approved the loan
            $table->unsignedBigInteger('marketcode_id')->nullable(); // User who approved the loan
            // Record Timestamps
            $table->timestamps();

            // Foreign Key Constraints (Uncomment if needed)
            $table->foreign('member_id')->references('id')->on('memebers')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('associate_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('plan_id')->references('id')->on('loan_against_deposit_plans')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('disbursed_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('document_verified_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('document_rejected_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('application_approved_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('application_rejected_by')->references('id')->on('users')->onDelete('set null');

            $table->foreign('application_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('marketcode_id')->references('id')->on('market_codes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_a_d_s');
    }
};
