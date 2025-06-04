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
        Schema::create('fd_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_code')->unique();
            $table->string('plan_name');
            $table->decimal('min_amount', 10, 2); // Min Amount (Decimal to handle money values)
            $table->string('lockin_period'); // Lock-in Period (e.g. 6 months, 1 year, etc.)
            $table->decimal('annual_interest_rate', 5, 2); // Annual interest rate in percentage
            $table->decimal('senior_citizen_annual_interest_rate', 5, 2)->nullable(); // Senior citizen interest rate
            $table->string('interest_lockin_period'); // Interest lock-in period (6 months, 1 year, etc.)
            $table->enum('tenure_type', ['month', 'year']); // Tenure type (month/year)
            $table->integer('tenure_value'); // Tenure value (number of months/years)
            $table->enum('interest_payout', ['Monthly', 'Yearly', 'Quarterly']); // Interest payout frequency
            $table->decimal('cancellation_charge', 10, 2)->nullable(); // Cancellation charge if applicable
            $table->decimal('penal_charge', 10, 2)->nullable(); // Penal charge if applicable
            $table->boolean('active')->default(true); // Active status (true/false)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fd_plans');
    }
};
