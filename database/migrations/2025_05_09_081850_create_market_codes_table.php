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
        Schema::create('market_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();                  // e.g., MK001
            $table->string('area_name');                       // e.g., Village Agre
            $table->string('pincode');                         // Postal code
            $table->string('district')->nullable(); 
            $table->string('state')->nullable();               // Optional
            $table->string('country')->default('India');       // Default to India
            $table->decimal('latitude', 10, 6)->nullable();    // For map
            $table->decimal('longitude', 10, 6)->nullable();   // For map
            $table->boolean('status')->default(1);             // 1 = active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_codes');
    }
};
