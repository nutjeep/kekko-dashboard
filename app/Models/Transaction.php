<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\FormattedDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
   use SoftDeletes, FormattedDate;
   
   protected $guarded = [
      'id', 'created_at', 'updated_at', 'deleted_at'
   ];

   protected static function boot()
   {
      parent::boot();

      static::creating(function ($model) {
         $today = Carbon::today()->format('dmy');

         // Hitung jumlah transaksi hari ini
         $count = self::whereDate('created_at', Carbon::today())->count() + 1;

         // Format urutan: 001, 002, dst.
         $sequence = str_pad($count, 3, '0', STR_PAD_LEFT);

         $random_word = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
         $words = substr($random_word, 0, 5);
         
         $model->invoice_number = 'INV-' . $words. '-' . $today . '-' . $sequence;
      });
   }

   public function order()
   {
      return $this->belongsTo(Order::class);
   }
}
