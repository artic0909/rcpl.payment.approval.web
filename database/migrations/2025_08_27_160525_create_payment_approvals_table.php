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
        Schema::create('payment_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // FK to users/staff
            $table->date('date');
            $table->json('request_for')->nullable(); // store as JSON array
            $table->string('vendor_name');
            $table->string('vendor_code')->nullable();
            $table->string('site_name')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('amount_in_words');
            $table->text('item_description')->nullable();
            $table->string('party_account_number');
            $table->string('party_ifsc_code');
            $table->string('party_bank_name');
            $table->string('party_bank_branch_name');
            $table->timestamps();

            // optional foreign key (if you want to link to users table)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_approvals');
    }
};
