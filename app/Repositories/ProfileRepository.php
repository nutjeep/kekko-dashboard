<?php
namespace App\Repositories;

use App\Models\User;

class ProfileRepository extends BaseRepository
{

  public function __construct(User $model)
  {
    parent::__construct($model);
  }

  public function getProfile($id)
  {
    $data = $this->find($id)
      ->select('id', 'name', 'username', 'email', 'password', 'phone');
    
    return $data;
  }
}