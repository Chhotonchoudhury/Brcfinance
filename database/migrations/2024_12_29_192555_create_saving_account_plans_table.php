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
        Schema::create('saving_account_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_code')->unique(); // Plan code
            $table->string('plan_name'); // Plan name
            $table->decimal('min_opening_balance', 15, 2); // Min Opening Balance
            $table->decimal('min_avg_balance', 15, 2); // Min Average Balance
            $table->decimal('annual_interest_rate', 5, 2); // Annual Interest Rate (%)
            $table->decimal('senior_citizen_annual_interest_rate', 5, 2)->nullable(); // Senior Citizen Annual Interest Rate (%)
            $table->enum('interest_payout', ['Monthly', 'Yearly', 'Half Yearly', 'Quarterly']); // Interest Payout Frequency
            $table->decimal('lock_in_amount', 15, 2); // Lock-in Amount
            $table->decimal('min_monthly_avg_balance_charge', 15, 2); // Min Monthly Avg Balance Charge
            $table->enum('sms_charge_frequency', ['Monthly', 'Yearly']); // SMS Charge Frequency
            $table->decimal('sms_charge', 10, 2); // SMS Charge
            $table->enum('card_charge_frequency', ['Monthly', 'Yearly']); // Card Charges Frequency
            $table->decimal('card_charge', 10, 2); // Card Charge
            $table->integer('free_ifsc_collection_per_month')->default(0); // Free IFSC collection per month
            $table->boolean('active')->default(true);  // Active/Deactive column
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving_account_plans');
    }
};
