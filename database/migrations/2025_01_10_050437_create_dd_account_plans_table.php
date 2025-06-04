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
        Schema::create('dd_account_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_code')->unique(); // Unique code for the plan
            $table->string('plan_name'); // Name of the plan
            $table->decimal('minimum_amount', 10, 2); // Minimum amount required
            $table->integer('lock_in_period')->nullable(); // Lock-in period in months or days
            $table->decimal('annual_interest_rate', 5, 2); // Annual interest rate for general customers
            $table->decimal('senior_citizen_annual_interest_rate', 5, 2)->nullable(); // Senior citizen annual interest rate
            $table->decimal('ladies_annual_interest_rate', 5, 2)->nullable(); // Ladies annual interest rate
            $table->decimal('ex_service_annual_interest_rate', 5, 2)->nullable(); // Ex-service annual interest rate
            $table->integer('interest_lock_in_period')->nullable(); // Lock-in period for interest in months/days
            $table->string('tenure_type')->default('days'); // Tenure type (e.g., days, months)
            $table->integer('tenure_value'); // Tenure value (duration)
            
            // Using enum for RD/DD frequency, assuming these are the only options
            $table->enum('rd_dd_frequency', ['monthly', 'quarterly', 'annually', 'daily'])->nullable(); // Recurring deposit/demand deposit frequency
            
            // Using enum for interest compounding interval, assuming typical options
            $table->enum('interest_compounding_interval', ['monthly', 'quarterly', 'annually'])->nullable(); // Interest compounding interval (monthly/quarterly/annually)
            
            $table->decimal('cancellation_charge', 10, 2)->nullable(); // Cancellation charge
            $table->decimal('penal_charge', 10, 2)->nullable(); // Penal charge for non-compliance
            
            // Using boolean for skip days, no changes needed
            $table->boolean('skip_sunday')->default(false); // Whether to skip Sunday
            $table->boolean('skip_saturday')->default(false); // Whether to skip Saturday
            
            // Active status, remains as is
            $table->boolean('is_active')->default(true); // Status of the plan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_account_plans');
    }
};
