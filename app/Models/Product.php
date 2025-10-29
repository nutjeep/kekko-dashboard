<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Traits\FormattedDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  use SoftDeletes, FormattedDate;

  protected $guarded = [
    'id', 'created_at', 'updated_at', 'deleted_at'
  ];

  protected $hidden = [
    'created_at', 'updated_at', 'deleted_at'
  ];

  protected static function boot()
  {
    parent::boot();

    static::created(function ($model) {
      $count = $model
              ->where('type', $model->type)
              ->count();
      
      $sequence = str_pad($count, 4, '0', STR_PAD_LEFT);
      
      if ($model->type == 'digital') {
        $model->sku = 'KEKKO-PRD-DIG-' . $sequence;
      } 
      else if ($model->type == 'printed') {
        $model->sku = 'KEKKO-PRD-PRT-' . $sequence;
      }

      // SLUG
      $theme_slug = Str::slug($model->name . '-' . $sequence);
      $model->slug = $theme_slug;
      
      $model->save();
    });
  }

  public function theme()
  {
    return $this->belongsTo(ProductTheme::class);
  }

  public function package()
  {
    return $this->belongsTo(ProductPackage::class);
  }

  public function getProductThemeNameAttribute()
  {
    return $this->theme->name ?? '-';
  }

  public function getProductPackageNameAttribute()
  {
    return $this->package->name ?? '-';
  }
}
