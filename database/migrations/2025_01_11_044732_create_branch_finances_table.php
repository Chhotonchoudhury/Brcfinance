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
        Schema::create('branch_finances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id'); // Foreign key to the branches table
            $table->decimal('total_deposits', 20, 2)->default(0); // Total deposits in the branch
            $table->decimal('total_withdrawals', 20, 2)->default(0); // Total withdrawals in the branch
            $table->decimal('total_income', 20, 2)->default(0); // Total income (e.g., service charges, interest)
            $table->decimal('total_expenses', 20, 2)->default(0); // Total expenses
            $table->decimal('net_balance', 20, 2)->default(0); // Net balance (deposits - withdrawals + income - expenses)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_finances');
    }
};
