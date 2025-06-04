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
        Schema::create('shares', function (Blueprint $table) {
            $table->id();
            $table->morphs('shareholder'); // Polymorphic relationship
            $table->string('share_range_start')->nullable(); // Starting number of the range
            $table->string('share_range_end')->nullable(); // Ending number of the range
            $table->decimal('nominal_value', 10, 2); // Nominal value of the share
            $table->integer('number_of_shares'); // Number of shares in the record
            $table->decimal('purchase_price', 10, 2); // Purchase price of the share
            $table->enum('share_type', ['issued', 'buy', 'sell', 'transfer'])->default('issued'); // Type of share transaction
            $table->date('date'); // Date of the share transaction or record
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status of the share (active or inactive)
            $table->boolean('is_paid')->default(false); // Indicates if the shares are paid
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shares');
    }
};
