<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
   protected array $products = [
      [
         'name' => 'Mansion',
         'type' => 'digital',
         'is_active' => true,
      ],
      [
         'name' => 'Javanava',
         'type' => 'digital',
         'is_active' => true,
      ],
      [
         'name' => 'Java Heritage',
         'type' => 'digital',
         'is_active' => true,
      ],
      [
         'name' => 'Bali Heritage',
         'type' => 'digital',
         'is_active' => true,
      ],
      [
         'name' => 'Minang Heritage',
         'type' => 'digital',
         'is_active' => true,
      ],
      [
         'name' => 'Green Gables',
         'type' => 'digital',
         'is_active' => true,
      ],
   ];
   
   public function run(): void
   {
      $productsSeed = $this->products;
      foreach ($productsSeed as $product) {
         $product_exist = Product::where('name', $product['name'])->first();
         if ($product_exist) {
            continue;
         }

         Product::create([
            'name' => $product['name'],
            'type' => $product['type'],
            'is_active' => $product['is_active'],
            'created_at' => now(),
            'updated_at' => now(),
         ]);
      }
   }
}
