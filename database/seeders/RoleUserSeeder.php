<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
   protected array $roles = [
      [
         'name' => 'superadmin',
      ],
      [
         'name' => 'employee',
      ],
   ];

   public function run(): void
   {
      $rolesSeed = $this->roles;
      foreach ($rolesSeed as $role) {
         $role_exists = RoleUser::where('name', $role['name'])->first();
         if ($role_exists) {
            continue;
         }

         RoleUser::create([
            'name' => $role['name'],
            'created_at' => now(),
            'updated_at' => now(),
         ]);
      }
   }
}
