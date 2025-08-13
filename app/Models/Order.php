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

   protected $appends = ['user_name'];

   public function user()
   {
      return $this->belongsTo(User::class, 'user_id');
   }

   protected $casts = [
      'order_information' => 'array',
      'groom_bride_data' => 'array',
      'agenda_data' => 'array'
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
         $today = Carbon::today()->format('ddmmyy');
         $sequence = str_pad($model->id, 3, '0', STR_PAD_LEFT);
         $random_word = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
         $words = substr($random_word, 0, 5);
         $model->order_id = 'ORDER_ID-' . $words . $today . '-' . $sequence;
      });
   }   

   // === ACCESSORS ===
   public function getUserNameAttribute()
   {
      return $this->user?->name ?? '-';
   }
}