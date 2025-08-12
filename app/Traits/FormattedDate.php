<?php

namespace App\Traits;

use Carbon\Carbon;

trait FormattedDate
{
   public function getFormattedCreatedAtAttribute()
   {
      return Carbon::parse($this->created_at)->translatedFormat('d F Y');
   }

   public function getFormattedUpdatedAtAttribute()
   {
      return Carbon::parse($this->updated_at)->translatedFormat('d F Y');
   }
}