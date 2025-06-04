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
        Schema::table('rd_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->nullable()->after('agent_id'); // Add the member_id column
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade'); // Add foreign key

             // Add created_by column
             $table->unsignedBigInteger('created_by')->nullable()->after('updated_at'); // Add the created_by column
             $table->foreign('created_by')->references('id')->on('users')->onDelete('set null'); // Foreign key reference to users table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rd_accounts', function (Blueprint $table) {
            //
            $table->dropForeign(['employee_id']); // Drop the foreign key
            $table->dropColumn('employee_id');   // Drop the column

             // Drop foreign key and column for created_by
             $table->dropForeign(['created_by']);
             $table->dropColumn('created_by');
        });
    }
};
