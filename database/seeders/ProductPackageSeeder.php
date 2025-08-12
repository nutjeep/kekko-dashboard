<?php

namespace Database\Seeders;

use App\Models\ProductPackage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductPackageSeeder extends Seeder
{
   protected array $packages = [
      [
         'name' => 'Basic',
         'is_active' => true,
      ],
      [
         'name' => 'Premium',
         'is_active' => true,
      ],
      [
         'name' => 'Exlusive',
         'is_active' => true,
      ],
   ];

   public function run(): void
   {
      $packagesSeed = $this->packages;
      foreach ($packagesSeed as $package) {
         $package_exist = ProductPackage::where('name', $package['name'])->first();
         if ($package_exist) {
            continue;
         }

         ProductPackage::create([
            'name' => $package['name'],
            'is_active' => $package['is_active'],
            'created_at' => now(),
            'updated_at' => now(),
         ]);
      }
   }
}
