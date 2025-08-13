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
            $table->dateTime('order_date')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->string('status', 50)->nullable()->comment('pending | DP | Paid | Canceled');
            $table->string('dp_amount')->nullable();
            $table->integer('total_amount')->nullable();
            $table->string('notes')->nullable();
            $table->integer('order_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
