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
        Schema::create('finance_transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('transaction_type', ['deposit', 'withdrawal', 'income', 'expense', 'transfer'])->default('deposit'); // Type of transaction
            $table->decimal('amount', 20, 2); // Transaction amount
            $table->string('description')->nullable(); // Optional description
            $table->unsignedBigInteger('branch_id')->nullable(); // If the transaction is branch-specific
            $table->unsignedBigInteger('processed_by'); // User who processed the transaction

            // Foreign Key Relationships
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('processed_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_transactions');
    }
};
