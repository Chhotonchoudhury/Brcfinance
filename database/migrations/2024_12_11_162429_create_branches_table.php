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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('branch_name');
            $table->string('branch_code')->unique();
            $table->date('opening_date')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_no')->nullable();
            $table->boolean('payment_service')->default(true); // true for Active, false for Deactivate
            $table->boolean('transfer_service')->default(true); // true for Active, false for Deactivate
            $table->string('ifsc_code')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('country')->nullable();
            $table->text('notes')->nullable(); // Additional field for custom notes
            $table->boolean('status')->default(true); // true for Active, false for Deactivated
            $table->timestamps(); // For created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
