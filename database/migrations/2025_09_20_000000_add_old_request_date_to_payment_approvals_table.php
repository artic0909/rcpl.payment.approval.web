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
        if (!Schema::hasColumn('payment_approvals', 'old_request_date')) {
            Schema::table('payment_approvals', function (Blueprint $table) {
                $table->date('old_request_date')->nullable()->after('date');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_approvals', function (Blueprint $table) {
            $table->dropColumn('old_request_date');
        });
    }
};
