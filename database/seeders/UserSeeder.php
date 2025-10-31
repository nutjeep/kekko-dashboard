<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  protected array $users = [
    [
        'name' => 'Kekko',
        'username' => 'kekko',
        'email' => 'admin@kekkoinvitation.com',
        'phone' => '085730739878',
        'password' => 'password',
    ],
    [
        'name' => 'M Najib Abdulloh',
        'username' => 'najib',
        'email' => 'najib@kekkoinvitation.com',
        'phone' => '083850296250',
        'password' => 'password',
    ],
  ];
  
  public function run(): void
  {
    $usersSeed = $this->users;
    foreach ($usersSeed as $user) {
        $user_exist = User::where('email', $user['email'])->first();
        if ($user_exist) {
          continue;
        }

        User::create([
          'name' => $user['name'],
          'username' => $user['username'],
          'email' => $user['email'],
          'phone' => $user['phone'],
          'password' => Hash::make($user['password']),
          'created_at' => now(),
          'updated_at' => now(),
        ]);
    }
  }
}