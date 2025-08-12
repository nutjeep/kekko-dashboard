<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Traits\FormattedDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTheme extends Model
{
   use SoftDeletes, FormattedDate;
   
   protected $guarded = [
      'id', 'created_at', 'updated_at', 'deleted_at'
   ];

   protected static function boot()
   {
      parent::boot();

      static::creating(function ($model) {
         $theme_slug = Str::slug($model->name);
         $model->slug = $theme_slug;
      });
   }
}
