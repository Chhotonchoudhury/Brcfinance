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
        Schema::table('employees', function (Blueprint $table) {
            //
             // Login restrictions
             $table->json('allowed_days')->nullable()->after('is_active');
             $table->time('login_start_time')->nullable()->after('allowed_days');
             $table->time('login_end_time')->nullable()->after('login_start_time');
 
             // Bank cheque numbers
             $table->string('bank_cheque_1')->nullable()->after('ifsc_code');
             $table->string('bank_cheque_2')->nullable()->after('bank_cheque_1');
             $table->string('bank_cheque_3')->nullable()->after('bank_cheque_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            //
            $table->dropColumn([
                'allowed_days',
                'login_start_time',
                'login_end_time',
                'bank_cheque_1',
                'bank_cheque_2',
                'bank_cheque_3',
            ]);
        });
    }
};
