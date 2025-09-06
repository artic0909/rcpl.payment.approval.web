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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('state_code')->nullable();
            $table->string('vendor_code')->unique();
            $table->string('vendor_name');
            $table->json('vendor_category')->nullable(); // JSON field for multiple categories
            $table->string('vendor_address')->nullable();
            $table->string('vendor_account_number')->nullable();
            $table->string('vendor_ifsc_code')->nullable();
            $table->string('vendor_bank_name')->nullable();
            $table->string('vendor_bank_branch_name')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_mobile')->nullable();
            $table->string('contact_person_email')->nullable();
            $table->string('related_product_service')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
