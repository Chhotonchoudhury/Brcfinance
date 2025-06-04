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
        Schema::create('rd_interest_slabs', function (Blueprint $table) {
            $table->id();
            $table->integer('min_days')->comment('Minimum days');
            $table->integer('max_days')->comment('Maximum days');
            $table->decimal('percentage', 5, 2)->comment('Interest rate');
            $table->string('remarks')->nullable()->comment('Like "Pre Maturity" or "Full Maturity"');
            $table->boolean('status')->default(1);  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rd_interest_slabs');
    }
};
