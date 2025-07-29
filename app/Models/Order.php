<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
   use SoftDeletes;

   protected $guarded = [
      'id', 'created_at', 'updated_at', 'deleted_at'
   ];

   protected $casts = [
      'order_information' => 'array',
      'groom_bride_data' => 'array',
      'agenda_data' => 'array'
   ];

   public function getFormattedCreatedAtAttribute()
   {
      return Carbon::parse($this->created_at)->translatedFormat('d F Y');
   }
}
