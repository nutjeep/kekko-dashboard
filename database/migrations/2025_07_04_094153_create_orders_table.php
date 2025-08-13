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
      Schema::create('orders', function (Blueprint $table) {
         $table->id();
         $table->string('order_id')->unique();
         $table->string('customer_name', 200);
         $table->string('customer_phone', 16);
         $table->json('order_information')->nullable();
         $table->json('groom_bride_data')->nullable();
         $table->json('agenda_data')->nullable();
         $table->json('addons')->nullable();
         $table->string('status', 50)->nullable()->comment('pending | on progress | ready to check | done | canceled');
         $table->dateTime('due_date')->nullable();
         $table->integer('employee_id')->nullable();
         $table->timestamps();
         $table->softDeletes();

         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
