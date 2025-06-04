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
        Schema::create('authorized_capitals', function (Blueprint $table) {
            $table->id();
            $table->integer('total_shares')->unsigned();  // total authorized shares
            $table->decimal('nominal_value', 10, 2);  // value per share
            $table->decimal('paid_up_capital', 15, 2)->nullable(); // Paid Up Capital
            $table->integer('issued_shares')->default(0);  // total shares issued
            $table->integer('available_shares')->default(0);  // total shares available for issue
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authorized_capitals');
    }
};
