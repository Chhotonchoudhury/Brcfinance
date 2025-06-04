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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

                // New columns
            $table->unsignedBigInteger('type_id')->nullable(); // Big Integer for type_id
            $table->enum('user_type', ['SuperAdmin', 'Agent', 'Employee', 'Member', 'Promoter', 'Director']); // Enum for user_type
            $table->string('unique_code')->unique(); // Unique string for unique_code

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
