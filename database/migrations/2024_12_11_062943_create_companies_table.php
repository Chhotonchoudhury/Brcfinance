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
        Schema::create('companies', function (Blueprint $table) {
            
                $table->id();
                $table->timestamps();
                
                $table->string('name')->nullable();
                $table->text('about')->nullable();
                $table->string('address')->nullable();
                $table->string('location')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->date('incorp_date')->nullable(); // Incorporation date
                $table->string('category')->nullable();
                $table->string('class')->nullable();
                $table->string('soft_url')->nullable(); // Soft URL
                $table->string('cin_label')->nullable(); // CIN Label
                $table->string('pan')->nullable();
                $table->string('gst_no')->nullable(); // GST No
                $table->string('country')->nullable();
                $table->string('currency')->nullable();
                $table->string('state_of_registration')->nullable();
                $table->decimal('authorized_capital', 15, 2)->nullable(); // Authorized Capital
                $table->decimal('paid_up_capital', 15, 2)->nullable(); // Paid Up Capital
                $table->decimal('shares_nominal_value', 10, 2)->nullable(); // Shares Nominal Value
            
              // Add company logo and favicon columns
              $table->string('company_logo')->nullable();  // Store file path for the logo
              $table->string('favicon')->nullable();  // Store file path for the favicon
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
