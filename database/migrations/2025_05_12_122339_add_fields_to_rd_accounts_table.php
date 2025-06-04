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
        Schema::table('rd_accounts', function (Blueprint $table) {
             // New Fields
             $table->unsignedBigInteger('market_code_id')->nullable();  // Foreign key to market codes table
            
             $table->decimal('rd_installment_amount', 15, 2)->default(0); // Each RD contribution
             $table->decimal('principal_amount', 15, 2)->default(0); // Principal amount for RD
             $table->decimal('total_payable_amount', 15, 2)->default(0); // Total payable after interest
             $table->decimal('maturity_balance', 15, 2)->default(0); // Maturity balance
             $table->decimal('total_interest', 15, 2)->default(0); // Total interest amount on principal
             $table->date('maturity_date')->nullable();  // Maturity date (calculated based on tenure)
             $table->unsignedInteger('tenure_duration_days')->nullable(); // Tenure duration in days
             $table->decimal('interest_rate_percentage', 5, 2)->default(0); // Interest rate percentage
             
              // Account Status (Active, Closed, Matured, Premature)
             $table->enum('rd_account_status', ['active', 'closed', 'matured', 'premature_closed'])->default('active');
 
             // Disbursement Fields
             $table->enum('disbursement_status', ['pending', 'approved', 'rejected', 'paid'])->default('pending'); // Disbursement status
             $table->timestamp('disbursement_requested_at')->nullable(); // When disbursement was requested
             $table->unsignedBigInteger('disbursement_requested_by')->nullable(); // User who requested disbursement
             $table->timestamp('disbursement_approved_at')->nullable(); // When disbursement was approved
             $table->unsignedBigInteger('disbursement_approved_by')->nullable(); // User who approved disbursement
             $table->timestamp('disbursed_at')->nullable(); // Final disbursement date
             $table->unsignedBigInteger('disbursed_by')->nullable(); // User who disbursed the amount
             $table->decimal('disbursed_amount', 15, 2)->nullable(); // Disbursed amount
             $table->string('disbursement_remarks')->nullable(); // Disbursement remarks
             $table->boolean('disbursement_tds_applied')->default(false); // Was TDS deducted?
             $table->decimal('disbursement_tds_amount', 15, 2)->nullable(); // TDS amount deducted
 
             // Define Foreign Key Constraints
             $table->foreign('market_code_id')->references('id')->on('market_codes'); // Market code association
             $table->foreign('disbursement_requested_by')->references('id')->on('users'); // Foreign key to users table
             $table->foreign('disbursement_approved_by')->references('id')->on('users'); // Foreign key to users table
             $table->foreign('disbursed_by')->references('id')->on('users'); // Foreign key to users table for disbursement
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rd_accounts', function (Blueprint $table) {
             // Remove the newly added columns and foreign key constraints
             $table->dropForeign(['market_code_id']);
             $table->dropForeign(['disbursement_requested_by']);
             $table->dropForeign(['disbursement_approved_by']);
             $table->dropForeign(['disbursed_by']);
             $table->dropColumn([
                 'market_code_id',
                 'rd_installment_amount',
                 'principal_amount',
                 'total_payable_amount',
                 'maturity_balance',
                 'total_interest',
                 'maturity_date',
                 'tenure_duration_days',
                 'interest_rate_percentage',
                 'disbursement_status',
                 'disbursement_requested_at',
                 'disbursement_requested_by',
                 'disbursement_approved_at',
                 'disbursement_approved_by',
                 'disbursed_at',
                 'disbursed_by',
                 'disbursed_amount',
                 'disbursement_remarks',
                 'disbursement_tds_applied',
                 'disbursement_tds_amount'
             ]);
        });
    }
};
