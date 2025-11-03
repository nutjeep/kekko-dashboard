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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 50);
            $table->timestamp('order_date')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->string('status', 50)->nullable()->comment('pending | DP | Paid | Canceled');
            $table->string('dp_amount')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('notes')->nullable();
            $table->foreignId('order_id')->nullable()->constrained('orders')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
