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
        Schema::create('account_transactions', function (Blueprint $table) {
            $table->id();
            $table->morphs('transaction'); // Polymorphic relationship to link transactions to any account type
            $table->enum('account_type', ['savings', 'dd', 'rd', 'fd']);  // Type of transaction
            $table->enum('action_type', ['deposit', 'withdrawal', 'transfer', 'charge']);  // Type of transaction
            $table->decimal('amount', 15, 2);  // Amount of the transaction
            $table->string('payment_mode')->nullable();  // Payment mode (cash, cheque, online, etc.)

            // Cheque-related fields
            $table->string('cheque_number')->nullable(); // Cheque number
            $table->string('bank_name')->nullable(); // Name of the bank
            $table->string('branch_name')->nullable(); // Bank branch name
            $table->date('cheque_date')->nullable(); // Date on the cheque

            // Online transaction-related fields
            $table->string('online_transaction_id')->nullable(); // Transaction ID for online payments
            $table->string('payment_gateway')->nullable(); // Payment gateway (e.g., PayPal, Razorpay, etc.)
            $table->string('remarks')->nullable(); // Optional remarks or reference for the transaction

            // Cash denominations
            $table->integer('cash_1')->nullable()->default(0); // Count of ₹1 notes
            $table->integer('cash_5')->nullable()->default(0); // Count of ₹5 notes
            $table->integer('cash_10')->nullable()->default(0); // Count of ₹10 notes
            $table->integer('cash_20')->nullable()->default(0); // Count of ₹20 notes
            $table->integer('cash_50')->nullable()->default(0); // Count of ₹50 notes
            $table->integer('cash_100')->nullable()->default(0); // Count of ₹100 notes
            $table->integer('cash_200')->nullable()->default(0); // Count of ₹200 notes
            $table->integer('cash_500')->nullable()->default(0); // Count of ₹500 notes

            // Status fields
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Transaction status
            $table->unsignedBigInteger('approved_by')->nullable(); // User who approved/rejected the transaction
            $table->timestamp('approved_at')->nullable(); // Date and time of approval/rejection


            $table->timestamp('transaction_date')->nullable();  // Date and time of transaction
            $table->unsignedBigInteger('processed_by')->nullable();  // User who processed the transaction

            // Foreign Key Relationships
            $table->foreign('processed_by')->references('id')->on('users');  // Foreign key to users table
            $table->foreign('approved_by')->references('id')->on('users');  // Foreign key to users table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_transactions');
    }
};
