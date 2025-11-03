<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable;

  /**
    * The attributes that are mass assignable.
    *
    * @var list<string>
  */
  protected $fillable = [
    'name',
    'username',
    'phone',
    'email',
    'password',
  ];

  /**
    * The attributes that should be hidden for serialization.
    *
    * @var list<string>
  */
  protected $hidden = [
    'password',
    'remember_token',
    'created_at',
    'updated_at',
    'email_verified_at'
  ];

  /**
    * Get the attributes that should be cast.
    *
    * @return array<string, string>
  */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function role(): BelongsTo
  {
    return $this->belongsTo(RoleUser::class, 'role_id');
  }

  public function isSuperadmin(): bool
  {
    return Cache::remember("user_{$this->id}_is_superadmin", 3600, function () {
      if (!$this->relationLoaded('role')) {
        $this->load('role');
      }
      return $this->role && $this->role->name == 'superadmin';
    });
  }

  public function isEmployee(): bool
  {
    return Cache::remember("user_{$this->id}_is_employee", 3600, function () {
      if (!$this->relationLoaded('role')) {
        $this->load('role');
      }
      return $this->role && $this->role->name == 'employee';
    });
  }
}
