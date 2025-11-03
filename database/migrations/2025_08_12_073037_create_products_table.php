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
      Schema::create('products', function (Blueprint $table) {
         $table->id();
         $table->string('name', 150);
         $table->string('sku')->nullable();
         $table->string('slug', 200)->nullable();
         $table->string('description')->nullable();
         $table->string('image')->nullable();
         $table->string('thumbnail')->nullable();
         $table->integer('quantity')->nullable();
         $table->integer('price')->nullable();
         $table->foreignId('theme_id')->nullable()->constrained('product_themes')->cascadeOnDelete();
         $table->foreignId('package_id')->nullable()->constrained('product_packages')->cascadeOnDelete();
         $table->string('type')->nullable()->comment('digital | printed');
         $table->boolean('is_active')->default(true)->nullable();
         $table->timestamps();
         $table->softDeletes();
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists('products');
   }
};
