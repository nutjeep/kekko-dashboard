<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileRepository extends BaseRepository
{

  public function __construct(User $model)
  {
    parent::__construct($model);
  }

  public function updatePassword($id, string $newPassword)
  {
    $user = User::findOrFail($id);

    $user->update([
      'password' => Hash::make($newPassword)
    ]);
    
    return $user;
  }
}