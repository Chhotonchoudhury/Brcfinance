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
        Schema::create('rd_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number')->unique();  // Unique account number
            $table->unsignedBigInteger('member_id');  // Foreign key to the members table
            $table->unsignedBigInteger('branch_id');  // Foreign key to the branches table
            $table->unsignedBigInteger('agent_id')->nullable();   // Foreign key to the agents table
            $table->unsignedBigInteger('rd_plan_id'); // Foreign key to the savings plans table
            $table->decimal('balance', 15, 2)->default(0); // Initial balance, defaults to 0
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Account status
            $table->enum('account_status', ['active', 'inactive', 'on_hold'])->default('inactive'); // Active/inactive status
            $table->boolean('is_joint')->default(false);  // Indicates if it's a joint account
            $table->unsignedBigInteger('joint_member_id')->nullable(); // Optional: ID for joint member (second member)
            $table->boolean('opened_with_less_minimum')->default(false); // Tracks if account opened with less minimum deposit
            $table->boolean('nominee')->default(false);  // Indicates if it's a joint account
            $table->boolean('tds')->default(false); 
            $table->boolean('st')->default(false); 
            $table->boolean('renew')->default(false); 

            $table->unsignedBigInteger('approved_by')->nullable(); // Foreign key to users table for the user who approved the account                                                  
            $table->timestamp('approved_at')->nullable(); //approved_at column to store the date and time the account was approved
            $table->string('notes')->nullable();
            $table->string('remarks')->nullable();
            $table->date('opeaning_date')->nullable();

            // Define the foreign key relationships
            $table->foreign('member_id')->references('id')->on('memebers');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('agent_id')->references('id')->on('users');
            $table->foreign('rd_plan_id')->references('id')->on('rd_account_plans');
            $table->foreign('joint_member_id')->references('id')->on('memebers'); // Foreign key to members table
            $table->foreign('approved_by')->references('id')->on('users'); // Foreign key to users table for the user who approved
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rd_accounts');
    }
};
