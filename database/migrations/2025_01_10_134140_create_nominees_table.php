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
        Schema::create('nominees', function (Blueprint $table) {
            $table->id();
            $table->morphs('account'); // Polymorphic relation (account_id and account_type columns)
            $table->string('nominee_name'); // Nominee's name
            $table->string('relationship'); // Relationship to account holder
            $table->enum('nominee_status', ['active', 'inactive'])->default('active'); // Nominee status
            $table->string('phone_number')->nullable(); // Nominee's phone number
            $table->string('aadhar_number')->nullable(); // Nominee's Aadhar number
            $table->string('voter_id_number')->nullable(); // Nominee's Voter ID number
            $table->text('address')->nullable(); // Nominee's address
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominees');
    }
};
