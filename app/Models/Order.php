<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\FormattedDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
  use SoftDeletes, FormattedDate;
  
  protected $guarded = [
    'id', 'created_at', 'updated_at', 'deleted_at'
  ];

  protected $hidden = [
    'updated_at', 'deleted_at'
  ];

  protected $appends = ['user_name', 'formatted_created_at', 'formatted_order_date', 'formatted_due_date'];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  protected $casts = [
    'order_information' => 'array',
    'groom_bride_data' => 'array',
    'agenda_data' => 'array',
    'addons' => 'array'
  ];

  const STATUSES = [
    'pending' => 'Pending',
    'on progress' => 'On Progress',
    'ready to check' => 'Ready to Check',
    'done' => 'Done',
    'canceled' => 'Canceled',
  ];

  protected static function boot()
  {
    parent::boot();
    
    static::creating(function ($model) {
      $today = Carbon::today()->format('dmy');
      $count = self::whereDate('created_at', Carbon::today())->count() + 1;
      $sequence = str_pad($count, 3, '0', STR_PAD_LEFT);
      $random_word = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
      $words = substr($random_word, 0, 5);
      $model->order_id = 'ORDER_ID-' . $words . '-' . $today . '-' . $sequence;
    });
  }   

  // === ACCESSORS ===
  public function getUserNameAttribute()
  {
    return $this->user?->name ?? '-';
  }

  public function formattedOrderDateAttribute()
  {
    return Carbon::parse($this->order_date)->translatedFormat('d F Y');
  }

  public function formattedCreatedAtAttribute()
  {
    return Carbon::parse($this->created_at)->translatedFormat('d F Y | H:i:s');
  }

  public function formattedDueDateAttribute()
  {
    return Carbon::parse($this->due_date)->translatedFormat('d F Y');
  }
}