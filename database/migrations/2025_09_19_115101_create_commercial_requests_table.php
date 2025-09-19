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
        Schema::create('commercial_requests', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('approval_status')->default('pending');
            $table->string('payment_status')->default('pending');
            $table->string('payment_type')->nullable();
            $table->decimal('amount', 15, 2)->default(0.00);
            $table->string('amount_in_words')->nullable();
            $table->text('remarks')->nullable();
            $table->string('reject_remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commercial_requests');
    }
};
